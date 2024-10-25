<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_SyaratJB di backend
    $kd_SyaratJB = $acakangka4only;
    $nm_SyaratJB = trim($_POST['nm_SyaratJB']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_SyaratJB kosong
    if (empty($nm_SyaratJB)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_SyaratJB sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_SyaratJB WHERE kd_SyaratJB = '$kd_SyaratJB'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_SyaratJB (kd_SyaratJB, nm_SyaratJB) VALUES('$kd_SyaratJB', '$nm_SyaratJB')");
            
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
