<?php
if (empty($_GET['page'])) {
    include('views/_depan.php');
} elseif ($_GET['page'] == 'logout') {
    include('logout.php');
}
// a. kategori level user
elseif ($_GET['page'] == 'navbar1') {
    include('views/_navbar1.php');
}
//b.daftar dan tambah data level user
elseif ($_GET['page'] == 'navbar2') {
    include('views/_navbar2.php');
}
// master navbar 2
elseif ($_GET['page'] == 'MasterNavbar2') {
    include('views/_masternavbar2.php');
}
// subab 1
elseif ($_GET['page'] == 'Susbab1') {
    include('views/_Susbab1Mv.php');
}
// subab2
elseif ($_GET['page'] == 'Susbab2') {
    include('views/_Susbab2Mv.php');
}
// c. crousel
elseif ($_GET['page'] == 'Crousel') {
    include('views/_Crousel.php');
}
// d. Jam Berkunjung
// master jam berkunjung 
elseif ($_GET['page'] == 'JamBerkunjung') {
    include('views/_JamBerkunjung.php');
}
// syarat jam berkunjung
elseif ($_GET['page'] == 'SyaratJamBerkunjung') {
    include('views/_SyaratJB.php');
}
// Ruangan Khusus
elseif ($_GET['page'] == 'Ruangan_Khusus') {
    include('views/_ruangankhusus.php');
}
// Ruangan Khusus
elseif ($_GET['page'] == 'Jadwal') {
    include('views/_jadwal.php');
}

// e. Jam Pendaftaran Pasien
// master klinik
elseif ($_GET['page'] == 'MasterKlinik') {
    include('views/_masterKlinik.php');
}
// master Jadwal PP
elseif ($_GET['page'] == 'MasterJadwalPP') {
    include('views/_masterJadwalPP.php');
}
// master Jadwal PP
elseif ($_GET['page'] == 'JadwalPP') {
    include('views/_jadwalPP.php');
}
// f. Layanan Unggulan 
elseif ($_GET['page'] == 'Excellent_Service') {
    include('views/_layananunggulan.php');
}
// g. Pegawai Teladan
elseif ($_GET['page'] == 'Exemplary_Employee') {
    include('views/_pegawaiteladan.php');
}
// h. dokter 
// spesialisasi
elseif ($_GET['page'] == 'SpesialisasiDokter') {
    include('views/_spesialisasiDokter.php');
}
// pendidikan
elseif ($_GET['page'] == 'MasterPendidikanDokter') {
    include('views/_MasterPendidikanDokter.php');
}
// Riwayat pendidikan dokter
elseif ($_GET['page'] == 'RiwayatPendidikanDokter') {
    include('views/_RiwayatPendidikanDokter.php');
}
// klinik
elseif ($_GET['page'] == 'klinik') {
    include('views/_klinik.php');
}
// master subspsialisdokter
elseif ($_GET['page'] == 'SubspesialisDokter') {
    include('views/_SubspesialisDokter.php');
}
// subspesialis dokter 
elseif ($_GET['page'] == 'Subspecialist_Doctorr') {
    include('views/_Subspecialist_Doctor.php');
}
// bidang keahlian
elseif ($_GET['page'] == 'BidangKeahlian') {
    include('views/_BidangKeahlian.php');
} 
// master dokter
elseif ($_GET['page'] == 'MasterDokter') {
    include('views/_masterdokter.php');
}
// tambah dokter rs
elseif ($_GET['page'] == 'AddMasterDokter') {
    include('views/_addmasterdokter.php');
}
// jadwal dokter 
elseif ($_GET['page'] == 'ScheduleDokter') {
    include('views/_jadwaldokter.php');
}
// prestasi dokter 
elseif ($_GET['page'] == 'AchievementDokter') {
    include('views/_prestasidokter.php');
}
// i berita
elseif ($_GET['page'] == 'BeritaTerbaru') {
    include('views/_News.php');
} elseif ($_GET['page'] == 'addBeritaTerbaru') {
    include('views/_addNews.php');
} elseif ($_GET['page'] == 'KategoriBerita') {
    include('views/_KategoriBerita.php');
} elseif ($_GET['page'] == 'editberita') {
    include('views/_editberita.php');
}
// j. mitra kerja sama
elseif ($_GET['page'] == 'Mitra_Kerja') {
    include('views/_mitrakerja.php');
}
// k. profil rumah sakit 
elseif ($_GET['page'] == 'Profil_Rumah_Sakit') {
    include('views/_profilRS.php');
// tambah profil RS
} elseif ($_GET['page'] == 'AddProfil_Rumah_Sakit') {
    include('views/_addprofilRS.php');
}
// upload file pdf 
// tambah profil RS
elseif ($_GET['page'] == 'FilePDF') {
    include('views/_addUploadFilePDF.php');
}
// l. tarif
elseif ($_GET['page'] == 'Tarif') {
    include('views/_tarif.php');
}
// tambah perda tarif
elseif ($_GET['page'] == 'Tarif_Perda') {
    include('views/_addtarifperda.php');
}
// tarif rawat jalan
elseif ($_GET['page'] == 'Tarif_Rawat_Jalan') {
    include('views/_tarifRJ.php');
} elseif ($_GET['page'] == 'Tarif_Master_Rawat_Inap') {
    include('views/_tarifmasterRI.php');
} elseif ($_GET['page'] == 'Tarif_Rawat_Inap') {
    include('views/_tarifRI.php');
}
// m. mater data
// hari 
elseif ($_GET['page'] == 'Hari') {
    include('views/_hari.php');
}
// jenis kelamin
elseif ($_GET['page'] == 'JenisKelamin') {
    include('views/_jeniskelamin.php');
}