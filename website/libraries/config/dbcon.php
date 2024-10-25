<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'kopijadul');
define('DB_NAME', 'db_web');
ini_set('date.timezone', 'Asia/Jakarta');

$year = date('Y');
$version = '23082024-1.0.1';
$main = 'dashboard';

//for Native
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false) {
    die('Koneksi database gagal : ' .mysqli_connect_error());
}