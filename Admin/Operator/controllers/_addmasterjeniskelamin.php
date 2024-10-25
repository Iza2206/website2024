<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_jeniskelamin di backend
    $kd_jeniskelamin = $acakangka4only;
    $nm_jeniskelamin = trim($_POST['nm_jeniskelamin']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_jeniskelamin kosong
    if (empty($nm_jeniskelamin)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_jeniskelamin sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_jeniskelamin WHERE kd_jeniskelamin = '$kd_jeniskelamin'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_jeniskelamin (kd_jeniskelamin, nm_jeniskelamin) VALUES('$kd_jeniskelamin', '$nm_jeniskelamin')");
            
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
