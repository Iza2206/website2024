<?php
require_once('../../libraries/config/dbcon.php');

// Mengambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

$kd_subab1nav2 = $data['kd_subab1nav2'];
$ket_subab1nav2 = $data['ket_subab1nav2'];

// Update status di database
$query = "UPDATE dt_subab1nav2 SET ket_subab1nav2 = ? WHERE kd_subab1nav2 = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $ket_subab1nav2, $kd_subab1nav2);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$mysqli->close();
?>
