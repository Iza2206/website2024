<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$kd_masternavbar2 = $_POST['kd_masternavbar2'];
$nm_subab1nav2 = trim($_POST['nm_subab1nav2']);
$link_subab1nav2 = trim($_POST['link_subab1nav2']);
$status = isset($_POST['status']) ? 'Aktif' : 'Non-aktif'; // Status sebagai string

// Validasi jika ada input yang kosong
if (empty($nm_subab1nav2) || empty($link_subab1nav2)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} else {
    // Generate kd_masternavbar2 di backend menggunakan variabel $acakangka4only
    $kd_subab1nav2 = $acakangka4only; // Pastikan $acakangka4only di-set dengan nilai unik sebelum digunakan

    // Prepared Statement untuk menghindari SQL Injection
    if ($stmt = $mysqli->prepare("SELECT * FROM dt_subab1nav2 WHERE kd_subab1nav2 = ?")) {
        $stmt->bind_param('s', $kd_subab1nav2);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = array('status' => 'error', 'message' => 'Kode Subab sudah ada.');
        } else {
            // Insert data baru ke database
            if ($insertStmt = $mysqli->prepare("INSERT INTO dt_subab1nav2 (kd_subab1nav2, kd_masternavbar2, nm_subab1nav2,  link_subab1nav2, ket_subab1nav2) VALUES(?, ?, ?, ?, ?)")) {
                $insertStmt->bind_param('sssss', $kd_subab1nav2, $kd_masternavbar2, $nm_subab1nav2, $link_subab1nav2, $status);
                if ($insertStmt->execute()) {
                    $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal menyimpan data. Error: ' . $insertStmt->error);
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
