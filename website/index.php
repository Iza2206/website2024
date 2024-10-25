<?php
include 'Teamplate/controllers/_function.php';

// Ambil rute dari query parameter, jika tidak ada set default ke 'home'
$route = isset($_GET['page']) ? $_GET['page'] : '/';

if (strpos($route, '?') !== false) {
    $route = explode('?', $route)[0];
}

// Panggil fungsi handleRoute dengan argumen yang tepat
handleRoute($route);
?>