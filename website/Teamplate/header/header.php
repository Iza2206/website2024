<?php
// Sertakan file konfigurasi di awal
require_once('libraries/config/dbcon.php');

// Mulai dengan deklarasi DOCTYPE dan HTML
echo '<!DOCTYPE html>';
echo '<html class="no-js" lang="zxx">';

// Bagian head
echo '<head>';
include('meta.php');
include('css.php'); 
echo '</head>';

// Bagian body
echo '<body>';
include('loader.php'); 
// include('topbar.php'); 
// include('navbar.php'); 
include('js.php'); 
// include('footer/footer.php'); 
echo '</body>';

// Tutup tag HTML
echo '</html>';
?>
