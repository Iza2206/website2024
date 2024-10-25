<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

$response = array();

// Cek apakah ada data yang dikirimkan melalui POST
    // Generate kd_lvluser di backend
    $kd_lvluser = $acakangka4only;
    $nm_lvluser = trim($_POST['nm_lvluser']); // Menghapus spasi di awal dan akhir

    // Validasi jika nm_lvluser kosong
    if (empty($nm_lvluser)) {
        $response = array('status' => 'error', 'message' => 'Harap isi level user.');
    } else {
        // Cek apakah kd_lvluser sudah ada di database
        $qryData = $mysqli->query("SELECT * FROM dt_lvluser WHERE kd_lvluser = '$kd_lvluser'")
        OR die(json_encode(array('status' => 'error', 'message' => 'Database query failed: ' . $mysqli->error)));

        $cekBaris = $qryData->num_rows;

        if ($cekBaris) {
            $response = array('status' => 'error', 'message' => 'Data Gagal disimpan. Kode Level User sudah ada.');
        } else {
            // Insert data baru ke database
            $insData = $mysqli->query("INSERT INTO dt_lvluser (kd_lvluser, nm_lvluser) VALUES('$kd_lvluser', '$nm_lvluser')");
            
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
