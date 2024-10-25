<?php
require_once('../../libraries/config/dbcon.php');

$response = array();

// Ambil dan dekode input JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validasi apakah data 'kd_subab2nav2' ada dan tidak kosong
if (!isset($input['kd_subab2nav2']) || empty($input['kd_subab2nav2'])) {
    $response = array('status' => 'error', 'message' => 'Kode Subab harus diisi.');
} else {
    $kd_subab2nav2 = trim($input['kd_subab2nav2']);

    // Prepared Statement untuk menghindari SQL Injection
    $query = "DELETE FROM dt_subab2nav2 WHERE kd_subab2nav2 = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $kd_subab2nav2);

        if ($stmt->execute()) {
            // Periksa jika ada baris yang dihapus
            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Data berhasil dihapus.');
            } else {
                $response = array('status' => 'error', 'message' => 'Data tidak ditemukan atau sudah dihapus.');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menghapus data. Error: ' . $stmt->error);
        }
        $stmt->close();
    } else {
        $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
