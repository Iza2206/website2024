<?php
require_once('../../libraries/config/dbcon.php');

// Ambil kode klinik dan spesialis dari query string
$kd_klinik = $_GET['kd_klinik'];
$kd_spesialis = $_GET['kd_spesialis'];

// Debug: Cek nilai yang diterima
error_log("kd_klinik: $kd_klinik, kd_spesialis: $kd_spesialis"); // Tambahkan ini untuk log

// Query untuk mendapatkan bidang keahlian berdasarkan klinik dan spesialis
$query = "SELECT * FROM dt_bidangkeahlian WHERE kd_klinik = ? AND kd_spesialis = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $kd_klinik, $kd_spesialis);
$stmt->execute();
$result = $stmt->get_result();

$bidangkeahlian = [];
while ($row = $result->fetch_assoc()) {
    $bidangkeahlian[] = $row;
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
if (empty($bidangkeahlian)) {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada bidang keahlian ditemukan untuk spesialis ini.']);
} else {
    echo json_encode(['status' => 'success', 'data' => $bidangkeahlian]); // Tambahkan status dan data
}
?>