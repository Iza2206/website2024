<?php

function handleRoute($route)
{
    // echo $route;
    // die();
    switch ($route) {
        case '/':
            include './konten/home.php';
            break;
        case 'ProfilRumahSakit':
            include './konten/profil.php';
            break;
        case 'ketersediaankamar':
            include './konten/ketersediaankamar.php';
            break;
        case 'JambesukPendaftaran':
            include './konten/jambesukpendaftaran.php';
            break;
        case 'JadwalJamBesuk':
            include './konten/jambesuk.php';
            break;
        case 'JadwalDokterList':
            include './konten/jadwaldokterList.php';
            break;
        case 'JadwalDokter':
            include './konten/jadwaldokter.php';
            break;
        case 'DokterDetail':
            include './konten/DokterDetail.php';
            break;
        case 'TarifLayanan':
            include './konten/tariflayanan.php';
            break;
        case 'DetailPelayananUnggulan':
            include './konten/detailpelayananunggulan.php';
            break;
        case 'Dokter':
            include './konten/doctor.php';
            break;
        case 'PegawaiTeladan':
            include './konten/ExemplaryEmployee.php';
            break;
        case 'Berita':
            include './konten/DetailBerita.php';
            break;
            // Tambahkan rute lainnya sesuai kebutuhan
        default:
            include './konten/404.html'; // Halaman tidak ditemukan
            break;
    }
}