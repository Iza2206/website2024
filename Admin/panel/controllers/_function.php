<?php
if(empty($_GET['page'])) {
    include('views/_depan.php');
}
elseif($_GET['page'] == 'logout') {
    include('logout.php');
}
//kategori level user
elseif($_GET['page'] == 'KategoriLvlUser') {
    include('views/_ktglvluser.php');
}
// daftar dan tambah data level user
elseif($_GET['page'] == 'UserLvlKategori') {
    include('views/_userlvl.php');
}
// TAMBAH DATA NAVBAR 1
elseif($_GET['page'] == 'TmbhNavbar1') {
    include('views/_tambahnavbar1.php');
}
// Master Crousel
elseif($_GET['page'] == 'Master_Crousel') {
    include('views/_mvcrousel.php');
}