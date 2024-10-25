<?php
require_once('../libraries/config/dbcon.php');
include('../libraries/function/libgenerator.php');
?>
<style>
        /* Default styles */
        .card-authentication1 {
            margin: 20px;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .card-authentication1 {
                width: 90%;
                padding: 15px;
            }
            
            .card-title {
                font-size: 1.2em;
            }
            
            .form-control {
                font-size: 0.9em;
            }

            .btn {
                padding: 10px;
                font-size: 0.9em;
            }
        }
        
        /* Back to Top Button */
        .back-to-top {
            display: none;
        }
        
        @media (max-width: 768px) {
            .back-to-top {
                display: block;
                position: fixed;
                bottom: 20px;
                right: 20px;
                font-size: 24px;
                background-color: #007bff;
                color: #fff;
                padding: 10px;
                border-radius: 50%;
            }
        }
    </style>
 <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card card-authentication1 mx-auto">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="../assets/images/logo-icon.png" alt="logo icon" style="width: 80px; height: 80px;">
                    </div>

                    <div class="card-title text-uppercase text-center py-3">Masuk</div>
                    <form action="controllers/_ceklogin" method="post">
                        <div class="form-group">
                            <label for="exampleInputUsername" class="sr-only">Username</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" name="username_passusers" id="exampleInputUsername" class="form-control input-shadow" placeholder="Enter Username" required="required">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" name="passwd_passusers" id="myInput" class="form-control input-shadow" placeholder="Enter Password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="icheck-material-white">
                                    <input type="checkbox" id="showPassword" onclick="myFunction()"/>
                                    <label for="showPassword">Cek Password</label>
                                </div>
                            </div>
                            <div class="form-group col-6 text-right">
                                <a href="reset-password.html">Reset Password</a>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" value="submit" name="submit" class="btn btn-light btn-block">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top">
        <i class="fa fa-angle-double-up"></i>
    </a>
    <!--End Back To Top Button-->

    <!--start color switcher-->
    <div class="right-sidebar">
        <div class="switcher-icon">
            <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
        </div>
        <div class="right-sidebar-content">
            <p class="mb-0">Gaussion Texture</p>
            <hr>
            <ul class="switcher">
                <li id="theme1"></li>
                <li id="theme2"></li>
                <li id="theme3"></li>
                <li id="theme4"></li>
                <li id="theme5"></li>
                <li id="theme6"></li>
            </ul>
            <p class="mb-0">Gradient Background</p>
            <hr>
            <ul class="switcher">
                <li id="theme7"></li>
                <li id="theme8"></li>
                <li id="theme9"></li>
                <li id="theme10"></li>
                <li id="theme11"></li>
                <li id="theme12"></li>
                <li id="theme13"></li>
                <li id="theme14"></li>
                <li id="theme15"></li>
            </ul>
        </div>
    </div>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>