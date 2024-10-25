<?php
require_once('../../libraries/config/dbcon.php');

// Pastikan permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah semua data yang diperlukan telah diterima
    if (isset($_POST['kd_oper'], $_POST['email_oper'], $_POST['acakangka'], $_POST['passwd'], $_POST['tanggal'])) {
        // Ambil data dari permintaan POST dan bersihkan dari potensi serangan SQL injection
        $kd_oper = mysqli_real_escape_string($mysqli, $_POST['kd_oper']);
        $email_oper = mysqli_real_escape_string($mysqli, $_POST['email_oper']);
        $acakangka = mysqli_real_escape_string($mysqli, $_POST['acakangka']);
        $passwd = mysqli_real_escape_string($mysqli, $_POST['passwd']);
        $tanggal = mysqli_real_escape_string($mysqli, $_POST['tanggal']);

        // Enkripsi password sebelum menyimpannya ke dalam database
        $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);

        // Persiapkan dan jalankan query penyimpanan data ke dalam database
        $query = "INSERT INTO dt_useroper (kd_useroper, kd_oper, username_oper, passwd_oper, tgl_rilis) 
                  VALUES ('$acakangka', '$kd_oper', '$email_oper', '$hashed_password', '$tanggal')";

        if ($mysqli->query($query) === TRUE) {
            // Jika query berhasil, kirim respons ke klien
            echo "Data berhasil disimpan.";
        } else {
            // Jika query gagal, kirim pesan kesalahan ke klien
            echo "Terjadi kesalahan dalam penyimpanan data: " . $mysqli->error;
        }
    } else {
        // Jika data yang diperlukan tidak lengkap, kirim respons ke klien
        echo "Data tidak lengkap.";
    }
} else {
    // Jika bukan permintaan POST, kirim respons ke klien bahwa metode tidak valid
    echo "Metode HTTP tidak valid.";
}
?>
