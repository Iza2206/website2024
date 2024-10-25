<?php
ob_start();
session_start();
if (!isset($_SESSION['username_passusers']) ||(trim ($_SESSION['username_passusers']) == '')) {
    if((time() - $_SESSION["last_login_time"]) > (24 * 60 * 60)) {
        header("location: logout");
        if((time() - $_SESSION["last_login_time"]) > 20){ // 900 = 15 * 60
            header("location: logout");
        } 
        else {
            $_SESSION["last_login_timestamp"] = time();
        }
    } 
    else {
        header("location: ../dashboard");
        exit();
    }
}
$_SESSION["last_login_time"] = time();
echo '<!DOCTYPE html>';
echo '<html lang="en" dir="ltr">';
echo '<head>';
include('../templates/backend/Operator/views/_meta.php'); //ok
echo '<title>Administrator</title>';
include('../templates/general/backend/layouts/_css.php'); //ok
echo '</head>';
echo '<body class="bg-theme bg-theme1">';
echo '<div id="wrapper">';
include('../templates/backend/Operator/views/_sidebar.php'); //ok
include('../templates/backend/Operator/views/_nav.php'); //ok
include('../Operator/controllers/_function.php'); //ok
echo '<div class="overlay toggle-menu"></div>';
include('../templates/general/backend/layouts/_js.php'); 
include('../templates/general/backend/layouts/_footer.php'); 
echo '</div>';

echo '</body></html>';

