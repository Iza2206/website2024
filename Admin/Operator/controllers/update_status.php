<?php
require_once('../../libraries/config/dbcon.php');

// Mengambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

$kd_masternavbar2 = $data['kd_masternavbar2'];
$ket_masternavbar2 = $data['ket_masternavbar2'];

// Update status di database
$query = "UPDATE dt_masternavbar2 SET ket_masternavbar2 = ? WHERE kd_masternavbar2 = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $ket_masternavbar2, $kd_masternavbar2);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$mysqli->close();
?>
