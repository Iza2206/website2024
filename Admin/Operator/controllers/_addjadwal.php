<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

$kd_Jadwal = $acakangka4only;
$kd_MasterJB = isset($_POST['kd_MasterJB']) ? $mysqli->real_escape_string($_POST['kd_MasterJB']) : '';
$waktu = isset($_POST['waktu']) ? $mysqli->real_escape_string($_POST['waktu']) : '-';  // Default value "-"
$jam_awal = isset($_POST['jam_awal']) ? $mysqli->real_escape_string($_POST['jam_awal']) : '';
$jam_akhir = isset($_POST['jam_akhir']) ? $mysqli->real_escape_string($_POST['jam_akhir']) : '';

// Cek apakah semua data sudah diisi
if (empty($kd_MasterJB) || empty($jam_awal) || empty($jam_akhir)) {
    $response = array('status' => 'error', 'message' => 'Harap lengkapi semua field kecuali waktu.');
} else {
    // Ambil nm_MasterJB berdasarkan kd_MasterJB dari tabel dt_masterjb
    $qryMasterJB = $mysqli->query("SELECT nm_MasterJB FROM dt_masterjb WHERE kd_MasterJB = '$kd_MasterJB'");

    if ($qryMasterJB->num_rows > 0) {
        // Dapatkan nm_MasterJB dari hasil query
        $rowMasterJB = $qryMasterJB->fetch_assoc();
        $nm_MasterJB = $rowMasterJB['nm_MasterJB'];

        // Cek apakah kd_Jadwal sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_jadwal WHERE kd_Jadwal = '$kd_Jadwal'");

        if ($qryData->num_rows > 0) {
            $response = array('status' => 'error', 'message' => 'Data gagal disimpan. Kode Jadwal sudah ada.');
        } else {
            // Insert data ke dt_jadwal
            $stmt = $mysqli->prepare("INSERT INTO dt_jadwal (kd_Jadwal, kd_MasterJB, nm_MasterJB, waktu, jam_awal, jam_akhir) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param('ssssss', $kd_Jadwal, $kd_MasterJB, $nm_MasterJB, $waktu, $jam_awal, $jam_akhir);

                if ($stmt->execute()) {
                    $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
                } else {
                    $response = array('status' => 'error', 'message' => 'Data gagal disimpan.');
                }

                $stmt->close();
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal mempersiapkan query.');
            }
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Master JB tidak ditemukan.');
    }
}

header('Content-Type: application/json');
echo json_encode($response);
$mysqli->close();
?>
