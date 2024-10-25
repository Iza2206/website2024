<?php
require_once('../../libraries/config/dbcon.php');
require_once('../../libraries/function/libgenerator.php');

// Mengecek apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nm_dokterdetail = $_POST['nm_dokterdetail'];
    $kd_jeniskelamin = $_POST['kd_jeniskelamin'];
    $kd_klinik = $_POST['kd_klinik'];
    $kd_spesialis = $_POST['kd_spesialis'];

    // Ambil kode dokter dari variabel $acakangka4only
    $kd_dokterdetail = $acakangka4only; // Asumsikan $acakangka4only sudah didefinisikan

    // Lokasi folder upload
    $uploadDir = '../../Gambar/Dokter/'; // Path folder upload
    $maxFileSize = 2 * 1024 * 1024; // Maksimal file 2 MB (dalam byte)
    
    // Menghandle upload foto dokter
    if (isset($_FILES['foto_dokterdetail']) && $_FILES['foto_dokterdetail']['error'] == 0) {
        $fileTmpPath = $_FILES['foto_dokterdetail']['tmp_name'];
        $fileName = basename($_FILES['foto_dokterdetail']['name']);
        $fileSize = $_FILES['foto_dokterdetail']['size'];
        $fileType = $_FILES['foto_dokterdetail']['type'];
        
        // Tambahkan kode dokter ke nama file gambar
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Ekstensi file
        $newFileName = $kd_dokterdetail . '.' . $fileExtension; // Gabungkan kd_dokterdetail dan ekstensi file
        $targetFilePath = $uploadDir . $newFileName;

        // Debugging: Memeriksa informasi file yang diupload
        error_log("Nama File: " . $fileName);
        error_log("Ukuran File: " . $fileSize);
        error_log("Tipe File: " . $fileType);
        error_log("Path Sementara: " . $fileTmpPath);
        
        // Cek apakah ukuran file sesuai dengan batas maksimum 2 MB
        if ($fileSize > $maxFileSize) {
            echo json_encode(['status' => 'error', 'message' => 'Ukuran file terlalu besar. Maksimal 2 MB.']);
            exit;
        }

        // Cek apakah file adalah gambar
        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            echo json_encode(['status' => 'error', 'message' => 'File yang diupload bukan gambar.']);
            exit;
        }

        // Cek apakah file sudah ada
        if (file_exists($targetFilePath)) {
            echo json_encode(['status' => 'error', 'message' => 'File sudah ada.']);
            exit;
        }

        // Cek apakah ekstensi file sesuai (hanya gambar)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['status' => 'error', 'message' => 'Hanya file gambar (JPG, JPEG, PNG, GIF) yang diperbolehkan.']);
            exit;
        }

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $foto_dokterdetail = $newFileName; // Menggunakan nama baru
        } else {
            // Debugging: Jika move_uploaded_file gagal
            error_log("Gagal memindahkan file ke: " . $targetFilePath);
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengupload file.']);
            exit;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diupload atau ada kesalahan dalam penguploadan file.']);
        exit;
    }

    // Query untuk menyimpan data dokter ke tabel dt_dokterdetail
    $query = "INSERT INTO dt_dokterdetail (kd_dokterdetail, nm_dokterdetail, foto_dokterdetail, kd_jeniskelamin, kd_klinik, kd_spesialis )
              VALUES ('$kd_dokterdetail', '$nm_dokterdetail', '$foto_dokterdetail', '$kd_jeniskelamin', '$kd_klinik', '$kd_spesialis')";

    if ($mysqli->query($query)) {
        echo json_encode(['status' => 'success', 'message' => 'Dokter berhasil ditambahkan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data dokter: ' . $mysqli->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Request tidak valid.']);
}
?>