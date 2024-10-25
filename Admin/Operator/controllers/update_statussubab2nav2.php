<?php
require_once('../../libraries/config/dbcon.php');

// Mengambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

$kd_subab2nav2 = $data['kd_subab2nav2'];
$ket_subab2nav2 = $data['ket_subab2nav2'];

// Update status di database
$query = "UPDATE dt_subab2nav2 SET ket_subab2nav2 = ? WHERE kd_subab2nav2 = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $ket_subab2nav2, $kd_subab2nav2);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$mysqli->close();
?>
