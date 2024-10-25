<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

$kd_jadwalPP = $acakangka4only; // Pastikan variabel $acakangka4only didefinisikan sebelumnya
$kd_MasterjamPP = isset($_POST['kd_MasterjamPP']) ? $mysqli->real_escape_string($_POST['kd_MasterjamPP']) : '';
$kd_MasterjadwalPP = isset($_POST['kd_MasterjadwalPP']) ? $mysqli->real_escape_string($_POST['kd_MasterjadwalPP']) : '';
$jam_awal_pp = isset($_POST['jam_awal_pp']) ? $mysqli->real_escape_string($_POST['jam_awal_pp']) : '';
$jam_akhir_pp = isset($_POST['jam_akhir_pp']) ? $mysqli->real_escape_string($_POST['jam_akhir_pp']) : '';

// Cek apakah semua data sudah diisi
if (empty($kd_MasterjamPP) || empty($kd_MasterjadwalPP) || empty($jam_awal_pp) || empty($jam_akhir_pp)) {
    $response = array('status' => 'error', 'message' => 'Harap lengkapi semua field kecuali waktu.');
} else {
    // Ambil nm_MasterjamPP berdasarkan kd_MasterjamPP dari tabel dt_masterjampp
    $qryMasterJB = $mysqli->query("SELECT nm_MasterjamPP FROM dt_masterjampp WHERE kd_MasterjamPP = '$kd_MasterjamPP'");

    if ($qryMasterJB->num_rows > 0) {
        $rowMasterJB = $qryMasterJB->fetch_assoc();
        $nm_MasterjamPP = $rowMasterJB['nm_MasterjamPP'];

        // Ambil nm_MasterjadwalPP berdasarkan kd_MasterjadwalPP dari tabel dt_masterjadwalpp
        $qryMasterjadwalJB = $mysqli->query("SELECT nm_MasterjadwalPP FROM dt_masterjadwalpp WHERE kd_MasterjadwalPP = '$kd_MasterjadwalPP'");

        if ($qryMasterjadwalJB->num_rows > 0) {
            $rowMasterjadwalJB = $qryMasterjadwalJB->fetch_assoc();
            $nm_MasterjadwalPP = $rowMasterjadwalJB['nm_MasterjadwalPP'];

            // Cek apakah kd_jadwalPP sudah ada di database
            $qryData = $mysqli->query("SELECT * FROM dt_jadwalpp WHERE kd_jadwalPP = '$kd_jadwalPP'");

            if ($qryData->num_rows > 0) {
                $response = array('status' => 'error', 'message' => 'Data gagal disimpan. Kode Jadwal sudah ada.');
            } else {
                // Insert data ke dt_jadwalpp
                $stmt = $mysqli->prepare("INSERT INTO dt_jadwalpp (kd_jadwalPP, kd_MasterjamPP, nm_MasterjamPP, kd_MasterjadwalPP, nm_MasterjadwalPP, jam_awal_pp, jam_akhir_pp) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param('sssssss', $kd_jadwalPP, $kd_MasterjamPP, $nm_MasterjamPP, $kd_MasterjadwalPP, $nm_MasterjadwalPP, $jam_awal_pp, $jam_akhir_pp);

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
            $response = array('status' => 'error', 'message' => 'Master Jadwal tidak ditemukan.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Master Jam tidak ditemukan.');
    }
}

header('Content-Type: application/json');
echo json_encode($response);
$mysqli->close();
?>
