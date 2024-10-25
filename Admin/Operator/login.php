<?php
require_once('../libraries/config/dbcon.php');//ok
echo '<!DOCTYPE html><html lang="en" dir="ltr"><head>';
include('../templates/frontend/Operator/views/_meta.php');
echo ' <title> Administrator </title>';
include('../templates/frontend/Operator/layouts/_css.php');
echo '</head>';
echo '<body class="bg-theme bg-theme1">';
include('../templates/frontend/Operator/controllers/_function.php');
include('../templates/frontend/Operator/layouts/_js.php');
echo '</body></html>';