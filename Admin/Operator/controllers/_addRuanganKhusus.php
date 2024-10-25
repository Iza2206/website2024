<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_RuanganKhusus di backend
    $kd_RuanganKhusus = $acakangka4only;
    $nm_RuanganKhusus = trim($_POST['nm_RuanganKhusus']); // Menghapus spasi di awal dan akhir
    $ket_Rk = trim($_POST['ket_Rk']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_RuanganKhusus kosong
    if (empty($nm_RuanganKhusus)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_RuanganKhusus sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_ruangankhusus WHERE kd_RuanganKhusus = '$kd_RuanganKhusus'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_ruangankhusus (kd_RuanganKhusus, nm_RuanganKhusus, ket_Rk) VALUES('$kd_RuanganKhusus', '$nm_RuanganKhusus', '$ket_Rk')");
            
            if ($insData) {
                $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
            } else {
                $response = array('status' => 'error', 'message' => 'Data Gagal disimpan.');
            }
        }
    }

    // Mengatur header response untuk JSON
    header('Content-Type: application/json');
    echo json_encode($response);
?>
