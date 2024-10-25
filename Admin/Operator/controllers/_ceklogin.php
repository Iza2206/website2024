<?php
session_start();
require_once('../../libraries/config/dbcon.php');

$timeout = 1;
$logout = '../logout.php';
$timeout = $timeout * 60;

// Memeriksa waktu sesi
if(isset($_SESSION['start_session'])) {
    $elapsed_time = time() - $_SESSION['start_session'];
    if($elapsed_time >= $timeout) {
        include('../logout.php'); // Logout jika waktu sesi sudah melebihi batas waktu
    }
}

if(isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    $username_passusers = stripslashes($_REQUEST['username_passusers']);
    $username_passusers = $mysqli->real_escape_string($username_passusers);
    $passwd_passusers = stripslashes($_POST['passwd_passusers']);
    $passwd_passusers = $mysqli->real_escape_string($passwd_passusers);

     // Prepared Statement untuk menghindari SQL injection
     $stmt = $mysqli->prepare("SELECT * FROM dt_passusers WHERE username_passusers = ?");
     $stmt->bind_param("s", $username_passusers);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();

    // Verifikasi password yang dimasukkan dengan password yang disimpan dalam basis data menggunakan password_verify()
    if ($row && password_verify($passwd_passusers, $row['passwd_passusers'])) {
        // Password cocok, lakukan proses login
        $_SESSION['username_passusers'] = $row['username_passusers'];
        $_SESSION['kd_passusers'] = $row['kd_passusers'];
        echo '<script language="JavaScript">
        alert("Login berhasil...");
        document.location = "../dashboard";
        </script>
        ';
    } else {
        // Password salah, tampilkan pesan kesalahan
        echo '<script language="JavaScript">
        alert("Password salah...");
        document.location = "../login";
        </script>
        ';
    }

    // Perbarui waktu sesi
    $_SESSION['start_session'] = time();
    $stmt->close();
}
?>
