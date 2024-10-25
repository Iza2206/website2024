<?php
// Include database connection
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi input
    $kd_subab1nav2 = isset($_POST['kd_subab1nav2']) ? trim($mysqli->real_escape_string($_POST['kd_subab1nav2'])) : '';
    $nm_subab1nav2 = isset($_POST['nm_subab1nav2']) ? trim($mysqli->real_escape_string($_POST['nm_subab1nav2'])) : '';
    $link_subab1nav2 = isset($_POST['link_subab1nav2']) ? trim($mysqli->real_escape_string($_POST['link_subab1nav2'])) : '';

    // Cek apakah ada field yang kosong
    if (empty($kd_subab1nav2) || empty($nm_subab1nav2) || empty($link_subab1nav2)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.']);
        exit;
    }

    // Siapkan statement untuk update
    $stmt = $mysqli->prepare("
        UPDATE dt_subab1nav2 
        SET nm_subab1nav2 = ?, link_subab1nav2 = ? 
        WHERE kd_subab1nav2 = ?
    ");

    // Cek apakah statement berhasil disiapkan
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
        exit;
    }

    // Binding parameter dengan tipe yang benar
    $stmt->bind_param('sss', $nm_subab1nav2, $link_subab1nav2, $kd_subab1nav2);

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
