<?php
require_once('../../libraries/config/dbcon.php');

if(isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
    $kd_oper = sha1(md5($_POST['kd_oper']));
    $nm_oper = $_POST['nm_oper'];
    $email_oper = $_POST['email_oper'];

    // Cek duplikat kd_oper
    $stmt = $mysqli->prepare("SELECT * FROM dt_oper WHERE kd_oper = ?");
    $stmt->bind_param("s", $kd_oper);
    $stmt->execute();
    $result = $stmt->get_result();
    $cekBaris = $result->num_rows;

    if($cekBaris) {
        echo '
        <script language="JavaScript">
        alert("Data Gagal disimpan. kd_oper sudah ada.");
        document.location = "../dashboard?page=iptOP";
        </script>
        ';
    } else {
        // Cek duplikat email_oper
        $stmt = $mysqli->prepare("SELECT * FROM dt_oper WHERE email_oper = ?");
        $stmt->bind_param("s", $email_oper);
        $stmt->execute();
        $result = $stmt->get_result();
        $cekEmail = $result->num_rows;

        if($cekEmail) {
            echo '
            <script language="JavaScript">
            alert("Data Gagal disimpan. Email sudah ada.");
            document.location = "../dashboard?page=iptOP";
            </script>
            ';
        } else {
            // Masukkan data baru
            $stmt = $mysqli->prepare("INSERT INTO dt_oper VALUES (null, ?, ?, ?)");
            $stmt->bind_param("sss", $kd_oper, $nm_oper, $email_oper);
            $insData = $stmt->execute();
            $stmt->close();

            if($insData) {
                echo '
                <script language="JavaScript">
                alert("Data berhasil disimpan.");
                document.location = "../dashboard?page=iptOP";
                </script>
                ';
            } else {
                echo '
                <script language="JavaScript">
                alert("Data Gagal disimpan. Penyimpanan gagal.");
                document.location = "../dashboard?page=iptOP";
                </script>
                ';
            }
        }
    }
}
?>
