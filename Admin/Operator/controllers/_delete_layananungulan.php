<?php
require_once('../../libraries/config/dbcon.php');

$response = array();

// Ambil dan dekode input JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validasi apakah data 'kd_serviceEx' ada dan tidak kosong
if (!isset($input['kd_serviceEx']) || empty($input['kd_serviceEx'])) {
    $response = array('status' => 'error', 'message' => 'Kode Navbar harus diisi.');
} else {
    $kd_serviceEx = trim($input['kd_serviceEx']);

    // Ambil nama file gambar sebelum menghapus data
    $query = "SELECT gambar_serviceEx FROM dt_serviceex WHERE kd_serviceEx = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $kd_serviceEx);
        $stmt->execute();
        $stmt->bind_result($gambar_serviceEx);
        $stmt->fetch();
        $stmt->close();

        // Hapus data dari database
        if ($stmt = $mysqli->prepare("DELETE FROM dt_serviceex WHERE kd_serviceEx = ?")) {
            $stmt->bind_param('s', $kd_serviceEx);

            if ($stmt->execute()) {
                // Periksa jika ada baris yang dihapus
                if ($stmt->affected_rows > 0) {
                    // Jika data dihapus, cek dan hapus gambar terkait
                    if (!empty($gambar_serviceEx)) {
                        $gambarPath = "../../Gambar/ServiceEx/" . $gambar_serviceEx;
                        
                        if (file_exists($gambarPath)) {
                            unlink($gambarPath); // Hapus gambar dari folder
                        }
                    }

                    $response = array('status' => 'success', 'message' => 'Data dan gambar berhasil dihapus.');
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
    } else {
        $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query untuk mengambil data gambar.');
    }
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$mysqli->close();
?>
