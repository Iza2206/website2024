<?php
require_once('../../libraries/config/dbcon.php');

// Mengambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

$kd_serviceEx = $data['kd_serviceEx'];
$status_serviceEx = $data['status_serviceEx'];

// Update status di database
$query = "UPDATE dt_serviceex SET status_serviceEx = ? WHERE kd_serviceEx = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $status_serviceEx, $kd_serviceEx);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$mysqli->close();
?>
