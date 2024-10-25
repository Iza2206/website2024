<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_kategorinews di backend
    $kd_kategorinews = $acakangka4only;
    $nm_kategorinews = trim($_POST['nm_kategorinews']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_kategorinews kosong
    if (empty($nm_kategorinews)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_kategorinews sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_kategorinews WHERE kd_kategorinews = '$kd_kategorinews'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_kategorinews (kd_kategorinews, nm_kategorinews) VALUES('$kd_kategorinews', '$nm_kategorinews')");
            
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
