<?php
require_once('../../libraries/config/dbcon.php');

$response = array();

// Ambil dan dekode input JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validasi apakah data 'kd_MasterjadwalPP' ada dan tidak kosong
if (!isset($input['kd_MasterjadwalPP']) || empty($input['kd_MasterjadwalPP'])) {
    $response = array('status' => 'error', 'message' => 'Kode Navbar harus diisi.');
} else {
    $kd_MasterjadwalPP = trim($input['kd_MasterjadwalPP']);

    // Prepared Statement untuk menghindari SQL Injection
    if ($stmt = $mysqli->prepare("DELETE FROM dt_masterjadwalpp WHERE kd_MasterjadwalPP = ?")) {
        $stmt->bind_param('s', $kd_MasterjadwalPP);

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
