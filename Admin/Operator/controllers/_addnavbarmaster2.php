<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Ambil dan sanitasi input
$nm_masternavbar2 = trim($_POST['nm_masternavbar2']);
$link_masternavbar2 = trim($_POST['link_masternavbar2']);
$status = isset($_POST['status']) ? 'Aktif' : 'Non-aktif'; // Status sebagai string

// Validasi jika ada input yang kosong
if (empty($nm_masternavbar2) || empty($link_masternavbar2)) {
    $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
} else {
    // Generate kd_masternavbar2 di backend menggunakan variabel $acakangka4only
    $kd_masternavbar2 = $acakangka4only; // Pastikan $acakangka4only di-set dengan nilai unik sebelum digunakan

    // Prepared Statement untuk menghindari SQL Injection
    if ($stmt = $mysqli->prepare("SELECT * FROM dt_masternavbar2 WHERE kd_masternavbar2 = ?")) {
        $stmt->bind_param('s', $kd_masternavbar2);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = array('status' => 'error', 'message' => 'Kode Navbar sudah ada.');
        } else {
            // Insert data baru ke database
            if ($insertStmt = $mysqli->prepare("INSERT INTO dt_masternavbar2 (kd_masternavbar2, nm_masternavbar2, link_masternavbar2, ket_masternavbar2) VALUES(?, ?, ?, ?)")) {
                $insertStmt->bind_param('ssss', $kd_masternavbar2, $nm_masternavbar2, $link_masternavbar2, $status);
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
