<?php
// Include database connection
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi input
    $kd_MasterJB = isset($_POST['kd_MasterJB']) ? trim($mysqli->real_escape_string($_POST['kd_MasterJB'])) : '';
    $nm_MasterJB = isset($_POST['nm_MasterJB']) ? trim($mysqli->real_escape_string($_POST['nm_MasterJB'])) : '';

    // Cek apakah ada field yang kosong
    if (empty($kd_MasterJB) || empty($nm_MasterJB)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.']);
        exit;
    }

    // Siapkan statement untuk update
    $stmt = $mysqli->prepare("
        UPDATE dt_masterjb 
        SET nm_MasterJB = ?
        WHERE kd_MasterJB = ?
    ");

    // Cek apakah statement berhasil disiapkan
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
        exit;
    }

    // Binding parameter dengan tipe yang benar
    $stmt->bind_param('ss', $nm_MasterJB, $kd_MasterJB);

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
