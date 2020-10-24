<?php

session_start();
include('../modules/Compl_Classes.php');
$us = new Admin('customers', 'email', 'crm');



?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Robust - Responsive Bootstrap 4 Admin Dashboard Template for Web Application</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-compact-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1"><img src="../app-assets/images/logo/logo-dark.png" alt="branding logo"></div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login</span></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal form-simple" method="post" action="index.php" novalidate>
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <input type="text" name="email" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your email" required>
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password" required>
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-6 col-12 text-center text-md-left">

                                    <?php
                            
                                        
                                        if(isset($_POST['login'])){

                                            $login = $us->login($_POST['email'], $_POST['password']);
                                            if($login){

                                                $_SESSION['email'] = $_POST['email'];


                                                



                                                $us->redirect('home.php');

                                            }else{

                                                echo"<h3 align=center><font color=red>Invalid credentials</font></h3>";
                                            }
                                        }

                                ?>
                                

                                </div>
                                
                            </div>
                            <button type="submit" name="login" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="">
                        <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>
                        <p class="float-sm-right text-center m-0">Don't have an account? <a href="signup.php" class="card-link">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>