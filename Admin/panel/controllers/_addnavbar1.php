<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil data dari POST
$alamat_navinfo = trim($_POST['alamat_navinfo']);
$kode_pos_navinfo = trim($_POST['kode_pos_navinfo']);
$email_navinfo = trim($_POST['email_navinfo']);
$hp_navinfo = trim($_POST['hp_navinfo']);
$hp2_navinfo = isset($_POST['hp2_navinfo']) ? trim($_POST['hp2_navinfo']) : null; // Handle hp2_navinfo

// Validasi jika ada input yang kosong
if (empty($alamat_navinfo) || empty($kode_pos_navinfo) || empty($email_navinfo) || empty($hp_navinfo)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} else {
    // Generate kd_navinfo di backend menggunakan variabel $acakangka4only
    $kd_navinfo = $acakangka4only; // Pastikan $acakangka4only di-set dengan nilai unik sebelum digunakan

    // Prepared Statement untuk menghindari SQL Injection
    if ($stmt = $mysqli->prepare("SELECT * FROM dt_navinfo WHERE kd_navinfo = ?")) {
        $stmt->bind_param('s', $kd_navinfo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = array('status' => 'error', 'message' => 'Kode Navinfo sudah ada.');
        } else {
            // Include hp2_navinfo in the insert query
            if ($insertStmt = $mysqli->prepare("INSERT INTO dt_navinfo (kd_navinfo, alamat_navinfo, kode_pos_navinfo, email_navinfo, hp_navinfo, hp2_navinfo) VALUES (?, ?, ?, ?, ?, ?)")) {
                // Bind hp2_navinfo as NULL if it's not provided
                $hp2_navinfo = empty($hp2_navinfo) ? null : $hp2_navinfo;
                $insertStmt->bind_param('ssssss', $kd_navinfo, $alamat_navinfo, $kode_pos_navinfo, $email_navinfo, $hp_navinfo, $hp2_navinfo);
                if ($insertStmt->execute()) {
                    $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
                }
                $insertStmt->close();
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
            }
        }
        $stmt->close();
    } else {
        $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
