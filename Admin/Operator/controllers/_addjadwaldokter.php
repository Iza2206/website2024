<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

$kd_dokterjadwal = $acakangka4only;
$kd_dokterdetail = isset($_POST['kd_dokterdetail']) ? $mysqli->real_escape_string($_POST['kd_dokterdetail']) : '';
$kd_MasterjamPP = isset($_POST['kd_MasterjamPP']) ? $mysqli->real_escape_string($_POST['kd_MasterjamPP']) : '';
$kd_hari = isset($_POST['kd_hari']) ? $mysqli->real_escape_string($_POST['kd_hari']) : '-';  // Default value "-"
$jam_awal = isset($_POST['jam_awal']) ? $mysqli->real_escape_string($_POST['jam_awal']) : '';
$jam_akhir = isset($_POST['jam_akhir']) ? $mysqli->real_escape_string($_POST['jam_akhir']) : '';

// Cek apakah semua data sudah diisi
if (empty($kd_dokterdetail) || empty($jam_awal) || empty($jam_akhir)) {
    $response = array('status' => 'error', 'message' => 'Harap lengkapi semua field kecuali kd_hari.');
} else {
    // Cek apakah kd_dokterjadwal sudah ada di database
    $qryData = $mysqli->query("SELECT * FROM dt_dokterjadwal WHERE kd_dokterjadwal = '$kd_dokterjadwal'");

    if ($qryData->num_rows > 0) {
        $response = array('status' => 'error', 'message' => 'Data gagal disimpan. Kode Jadwal sudah ada.');
    } else {
        // Insert data ke dt_dokterjadwal
        $stmt = $mysqli->prepare("INSERT INTO dt_dokterjadwal (kd_dokterjadwal, kd_dokterdetail, kd_hari, jam_awal, jam_akhir, kd_MasterjamPP) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssssss', $kd_dokterjadwal, $kd_dokterdetail, $kd_hari, $jam_awal, $jam_akhir, $kd_MasterjamPP);

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
}

header('Content-Type: application/json');
echo json_encode($response);
$mysqli->close();
?>
