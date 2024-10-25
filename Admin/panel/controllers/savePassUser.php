<?php
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_passusers = $_POST['kd_passusers'];
    $kd_lvluser = $_POST['kd_lvluser'];
    $kd_userslgn = $_POST['kd_userslgn'];
    $username_passusers = $_POST['username_passusers'];
    $passwd_passusers = password_hash($_POST['passwd_passusers'], PASSWORD_BCRYPT); // Enkripsi password

    $query = $mysqli->prepare("INSERT INTO dt_passusers (kd_passusers, kd_lvluser, kd_userslgn, username_passusers, passwd_passusers) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param('sssss', $kd_passusers, $kd_lvluser, $kd_userslgn, $username_passusers, $passwd_passusers);

    if ($query->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User berhasil dikunci dan data disimpan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak valid.']);
}
?>
