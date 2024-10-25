<?php
require_once('../../libraries/config/dbcon.php'); // Pastikan path ini benar

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $kd_Jadwal = $_POST['kd_Jadwal'];
    $kd_MasterJB = $_POST['kd_MasterJB'];
    $waktu = $_POST['waktu'];
    $jam_awal = $_POST['jam_awal'];
    $jam_akhir = $_POST['jam_akhir'];

    // Validasi data
    if (empty($kd_Jadwal) || empty($kd_MasterJB) || empty($waktu) || empty($jam_awal) || empty($jam_akhir)) {
        $response = array('status' => 'error', 'message' => 'Semua field harus diisi.');
        echo json_encode($response);
        exit;
    }

    // Ambil nm_MasterJB berdasarkan kd_MasterJB dari tabel dt_masterjb
    $qryMasterJB = $mysqli->query("SELECT nm_MasterJB FROM dt_masterjb WHERE kd_MasterJB = '$kd_MasterJB'");
    if ($qryMasterJB->num_rows > 0) {
        $rowMasterJB = $qryMasterJB->fetch_assoc();
        $nm_MasterJB = $rowMasterJB['nm_MasterJB'];
    } else {
        $response = array('status' => 'error', 'message' => 'Master JB tidak ditemukan.');
        echo json_encode($response);
        exit;
    }

    // Ambil kd_MasterJB lama dari database
    $oldMasterJB = '';
    $queryOldMasterJB = "SELECT kd_MasterJB FROM dt_jadwal WHERE kd_Jadwal = ?";
    if ($stmtOldMasterJB = $mysqli->prepare($queryOldMasterJB)) {
        $stmtOldMasterJB->bind_param('s', $kd_Jadwal);
        $stmtOldMasterJB->execute();
        $stmtOldMasterJB->bind_result($oldMasterJB);
        $stmtOldMasterJB->fetch();
        $stmtOldMasterJB->close();
    }

    // Jika kd_MasterJB berubah, update nama di tabel dt_masterjb
    if ($oldMasterJB !== $kd_MasterJB) {
        $queryUpdateMasterJB = "UPDATE dt_masterjb SET nm_MasterJB = ? WHERE kd_MasterJB = ?";
        if ($stmtUpdateMasterJB = $mysqli->prepare($queryUpdateMasterJB)) {
            $stmtUpdateMasterJB->bind_param('ss', $nm_MasterJB, $kd_MasterJB);
            if (!$stmtUpdateMasterJB->execute()) {
                $response = array('status' => 'error', 'message' => 'Gagal memperbarui nama master JB. Error: ' . $stmtUpdateMasterJB->error);
                echo json_encode($response);
                exit;
            }
            $stmtUpdateMasterJB->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyiapkan query untuk update nama master JB.');
            echo json_encode($response);
            exit;
        }
    }

    // Update data jadwal
    $queryUpdateJadwal = "UPDATE dt_jadwal SET kd_MasterJB = ?, nm_MasterJB = ?, waktu = ?, jam_awal = ?, jam_akhir = ? WHERE kd_Jadwal = ?";
    if ($stmtUpdateJadwal = $mysqli->prepare($queryUpdateJadwal)) {
        $stmtUpdateJadwal->bind_param('ssssss', $kd_MasterJB, $nm_MasterJB, $waktu, $jam_awal, $jam_akhir, $kd_Jadwal);
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
