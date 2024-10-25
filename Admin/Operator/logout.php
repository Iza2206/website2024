<?php
ob_start();
session_start();
$_SESSION['username_passusers'];
$_SESSION['id_userpanel'];

unset($_SESSION['username_passusers']);
unset($_SESSION['id_userpanel']);
session_unset();
session_destroy();
header('location: redirect');
ob_flush();