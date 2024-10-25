<?php
require_once('../libraries/config/dbcon.php');//ok
echo '<!DOCTYPE html><html lang="en" dir="ltr"><head>';
include('../templates/frontend/panel/views/_meta.php');
echo ' <title> Administrator </title>';
include('../templates/frontend/panel/layouts/_css.php');
echo '</head>';
echo '<body class="bg-theme bg-theme1">';
include('../templates/frontend/panel/controllers/_function.php');
include('../templates/frontend/panel/layouts/_js.php');
echo '</body></html>';