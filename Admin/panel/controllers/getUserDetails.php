<?php
require_once('../../libraries/config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_userslgn = $_POST['kd_userslgn'];

    $query = $mysqli->prepare("SELECT kd_lvluser, email_userslgn FROM dt_userslogin WHERE kd_userslgn = ?");
    $query->bind_param('s', $kd_userslgn);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'kd_lvluser' => $data['kd_lvluser'], 'email_userslgn' => $data['email_userslgn']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak valid.']);
}
?>
