<?php
$tokengenerator = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^%&**"';
$tokenANGKA = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$acak = substr(str_shuffle($tokengenerator),0,20);
$acak1 = substr(str_shuffle($tokengenerator),0,25);

$kodeangka = '0123456789abcdefghijklmn';
$acakangka = substr(str_shuffle($kodeangka),0,6);
$acakangka4only = substr(str_shuffle($tokenANGKA),0,4);