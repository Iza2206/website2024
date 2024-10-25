<?php
// Include database connection
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi input
    $kd_SyaratJB = isset($_POST['kd_SyaratJB']) ? trim($mysqli->real_escape_string($_POST['kd_SyaratJB'])) : '';
    $nm_SyaratJB = isset($_POST['nm_SyaratJB']) ? trim($mysqli->real_escape_string($_POST['nm_SyaratJB'])) : '';

    // Cek apakah ada field yang kosong
    if (empty($kd_SyaratJB) || empty($nm_SyaratJB)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.']);
        exit;
    }

    // Siapkan statement untuk update
    $stmt = $mysqli->prepare("
        UPDATE dt_syaratjb 
        SET nm_SyaratJB = ?
        WHERE kd_SyaratJB = ?
    ");

    // Cek apakah statement berhasil disiapkan
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
        exit;
    }

    // Binding parameter dengan tipe yang benar
    $stmt->bind_param('ss', $nm_SyaratJB, $kd_SyaratJB);

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
