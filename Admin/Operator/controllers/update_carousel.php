<?php
require_once('../../libraries/config/dbcon.php');

// Mengambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

$kd_crousel = $data['kd_crousel'];
$ket_crousel = $data['ket_crousel'];

// Update status di database
$query = "UPDATE dt_crousel SET ket_crousel = ? WHERE kd_crousel = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $ket_crousel, $kd_crousel);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$mysqli->close();
?>
