<?php
require_once('../../libraries/config/dbcon.php'); // Pastikan path ini benar

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $kd_JadwalPP = $_POST['kd_jadwalPP'];
    $kd_MasterjamPP = $_POST['kd_MasterjamPP'];
    $kd_MasterjadwalPP = $_POST['kd_MasterjadwalPP'];
    $jam_awal_pp = $_POST['jam_awal_pp'];
    $jam_akhir_pp = $_POST['jam_akhir_pp'];

    // Validasi data
    if (empty($kd_JadwalPP) || empty($kd_MasterjamPP) || empty($kd_MasterjadwalPP) || empty($jam_awal_pp) || empty($jam_akhir_pp)) {
        $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
        echo json_encode($response);
        exit;
    }

    // Ambil nm_MasterjamPP berdasarkan kd_MasterjamPP dari tabel dt_masterjampp
    $qryMasterjamPP = $mysqli->query("SELECT nm_MasterjamPP FROM dt_masterjampp WHERE kd_MasterjamPP = '$kd_MasterjamPP'");
    if ($qryMasterjamPP->num_rows > 0) {
        $rowMasterjamPP = $qryMasterjamPP->fetch_assoc();
        $nm_MasterjamPP = $rowMasterjamPP['nm_MasterjamPP'];
    } else {
        $response = array('status' => 'error', 'message' => 'Master jam tidak ditemukan.');
        echo json_encode($response);
        exit;
    }

    // Ambil nm_MasterjadwalPP berdasarkan kd_MasterjadwalPP dari tabel dt_masterjadwalpp
    $qryMasterjadwalPP = $mysqli->query("SELECT nm_MasterjadwalPP FROM dt_masterjadwalpp WHERE kd_MasterjadwalPP = '$kd_MasterjadwalPP'");
    if ($qryMasterjadwalPP->num_rows > 0) {
        $rowMasterjadwalPP = $qryMasterjadwalPP->fetch_assoc();
        $nm_MasterjadwalPP = $rowMasterjadwalPP['nm_MasterjadwalPP'];
    } else {
        $response = array('status' => 'error', 'message' => 'Master jadwal tidak ditemukan.');
        echo json_encode($response);
        exit;
    }

    // Update data jadwal
    $queryUpdateJadwal = "UPDATE dt_jadwalpp SET kd_MasterjamPP = ?, nm_MasterjamPP = ?, kd_MasterjadwalPP = ?, nm_MasterjadwalPP = ?, jam_awal_pp = ?, jam_akhir_pp = ? WHERE kd_jadwalPP = ?";
    if ($stmtUpdateJadwal = $mysqli->prepare($queryUpdateJadwal)) {
        $stmtUpdateJadwal->bind_param('sssssss', $kd_MasterjamPP, $nm_MasterjamPP, $kd_MasterjadwalPP, $nm_MasterjadwalPP, $jam_awal_pp, $jam_akhir_pp, $kd_JadwalPP);
        if ($stmtUpdateJadwal->execute()) {
            $response = array('status' => 'success', 'message' => 'Data jadwal berhasil diperbarui.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal memperbarui data jadwal. Error: ' . $stmtUpdateJadwal->error);
        }
        $stmtUpdateJadwal->close();
    } else {
        $response = array('status' => 'error', 'message' => 'Gagal menyiapkan query untuk update jadwal.');
    }

    // Tutup koneksi database
    $mysqli->close();
} else {
    $response = array('status' => 'error', 'message' => 'Metode request tidak valid.');
}

// Mengatur header response untuk JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
