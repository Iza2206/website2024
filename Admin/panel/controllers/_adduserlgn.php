<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

header('Content-Type: application/json');

try {
    // Menginisialisasi $kd_userslgn dengan nilai yang dihasilkan dari libgenerator.php
    $kd_userslgn = $acakangka4only; // Pastikan $acakangka4only sudah diinisialisasi dengan benar sebelumnya
    $nm_userlgn = $_POST['nm_userlgn'] ?? '';
    $email_userslgn = $_POST['email_userslgn'] ?? '';
    $lvluser = $_POST['lvluser'] ?? '';

    // Validasi data yang diperlukan
    if (empty($nm_userlgn) || empty($email_userslgn) || empty($lvluser)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Semua field harus diisi.'
        ]);
        exit;
    }

    // Validasi format email
    if (!filter_var($email_userslgn, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Format email tidak valid.'
        ]);
        exit;
    }

    // Memisahkan kd_lvluser dan nm_lvluser
    list($kd_lvluser, $nm_lvluser) = explode('|', $lvluser);

    // Cek apakah email user sudah ada
    $cekBaris = $mysqli->prepare("SELECT * FROM dt_userslogin WHERE email_userslgn = ?");
    $cekBaris->bind_param('s', $email_userslgn);
    $cekBaris->execute();
    $cekBaris->store_result();

    if ($cekBaris->num_rows > 0) {
        $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Email User sudah ada.');
    } else {
        // Insert data baru ke database
        $stmt = $mysqli->prepare("INSERT INTO dt_userslogin (kd_userslgn, nm_userlgn, email_userslgn, kd_lvluser, nm_lvluser) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $kd_userslgn, $nm_userlgn, $email_userslgn, $kd_lvluser, $nm_lvluser);

        if ($stmt->execute()) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. ' . $stmt->error);
        }

        $stmt->close();
    }

    $cekBaris->close();
    echo json_encode($response);

    $mysqli->close();

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ]);
}
?>
