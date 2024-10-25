<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_RPpendidikan di backend
    $kd_RPpendidikan = $acakangka4only;
    $nm_RPpendidikan = trim($_POST['nm_RPpendidikan']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_RPpendidikan kosong
    if (empty($nm_RPpendidikan)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_RPpendidikan sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_rppendidikan WHERE kd_RPpendidikan = '$kd_RPpendidikan'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_rppendidikan (kd_RPpendidikan, nm_RPpendidikan) VALUES('$kd_RPpendidikan', '$nm_RPpendidikan')");
            
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
