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
    $username_adm = stripslashes($_REQUEST['username_adm']);
    $username_adm = $mysqli->real_escape_string($username_adm);
    $passwd_adm = stripslashes($_POST['passwd_adm']);
    $passwd_adm = $mysqli->real_escape_string($passwd_adm);

     // Prepared Statement untuk menghindari SQL injection
     $stmt = $mysqli->prepare("SELECT * FROM dt_users WHERE username_adm = ?");
     $stmt->bind_param("s", $username_adm);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();

    // Verifikasi password yang dimasukkan dengan password yang disimpan dalam basis data menggunakan password_verify()
    if ($row && password_verify($passwd_adm, $row['passwd_adm'])) {
        // Password cocok, lakukan proses login
        $_SESSION['username_adm'] = $row['username_adm'];
        $_SESSION['kd_useradmin'] = $row['kd_useradmin'];
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
