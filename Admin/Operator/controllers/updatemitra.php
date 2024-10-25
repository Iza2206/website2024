<?php
require_once('../../libraries/config/dbcon.php');

// Mengambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

$kd_mitrawork = $data['kd_mitrawork'];
$status_mitrawork = $data['status_mitrawork'];

// Update status di database
$query = "UPDATE dt_mitrawork SET status_mitrawork = ? WHERE kd_mitrawork = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss', $status_mitrawork, $kd_mitrawork);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$mysqli->close();
?>
