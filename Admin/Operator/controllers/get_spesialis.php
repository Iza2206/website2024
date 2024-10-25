<?php
// Koneksi database
require_once('../../libraries/config/dbcon.php');


// Ambil kode klinik dari query string
$kd_klinik = $_GET['kd_klinik'];

// Query untuk mendapatkan spesialis berdasarkan klinik
$query = "SELECT * FROM dt_spesialis WHERE kd_klinik = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $kd_klinik);
$stmt->execute();
$result = $stmt->get_result();

$spesialis = [];
while ($row = $result->fetch_assoc()) {
    $spesialis[] = $row;
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($spesialis);
?>
