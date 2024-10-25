<?php
// Include database connection
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi input
    $kd_MasterjadwalPP = isset($_POST['kd_MasterjadwalPP']) ? trim($mysqli->real_escape_string($_POST['kd_MasterjadwalPP'])) : '';
    $nm_MasterjadwalPP = isset($_POST['nm_MasterjadwalPP']) ? trim($mysqli->real_escape_string($_POST['nm_MasterjadwalPP'])) : '';

    // Cek apakah ada field yang kosong
    if (empty($kd_MasterjadwalPP) || empty($nm_MasterjadwalPP)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.']);
        exit;
    }

    // Siapkan statement untuk update
    $stmt = $mysqli->prepare("
        UPDATE dt_masterjadwalpp 
        SET nm_MasterjadwalPP = ?
        WHERE kd_MasterjadwalPP = ?
    ");

    // Cek apakah statement berhasil disiapkan
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
        exit;
    }

    // Binding parameter dengan tipe yang benar
    $stmt->bind_param('ss', $nm_MasterjadwalPP, $kd_MasterjadwalPP);

    // Eksekusi statement dan cek apakah berhasil
    if ($stmt->execute()) {
        // Cek apakah ada baris yang terpengaruh
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
        } else {
            echo json_encode(['status' => 'warning', 'message' => 'No data was updated. The provided ID may not exist.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data: ' . $stmt->error]);
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
