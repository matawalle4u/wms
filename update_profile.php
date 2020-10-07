<?php

session_start();

$admin_roles = array('System', 'b2b');


include('modules/Compl_Classes.php');

if(isset($_SESSION['role'])){

    if(in_array($_SESSION['role'], $admin_roles)){


        $redir = array(
            'System'=>'admin/home.php',
            'b2b'=>'admin/b2b_admin.php'
        );


        $table ='admin';
    }else{

        $redir = array(
            'Warehouse Manager'=>'warehouse_manager.php',
            'Sales Agent'=>'sales.php',
            'Driver'=>'driver.php',
            'Warehouse Supervisor'=>'warehouse_supervisor.php'
        );


        $table = 'users';
    }

    $us = new Admin($table, 'phone', 'crm'); 
    
}else{
    $u = new Admin('users', 'phone', 'crm');
    $u->logout('index.php', 'User');
}










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
    <title>Update Prfile <?php echo $_SESSION['role'];?></title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    BEGIN VENDOR CSS -->

    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     -->
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                        <div class="p-1"><img src="app-assets/images/logo/logo-dark.png" alt="branding logo"></div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Update</span></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">


                    <form class="form-horizontal form-simple" method="post" action="" novalidate>
							<fieldset class="form-group position-relative has-icon-left mb-1">
								<input type="text" name="name" value="<?php echo $_SESSION['name'];?>" class="form-control form-control-lg input-lg" id="user-name" placeholder="User Name">
								<div class="form-control-position">
								    <i class="ft-user"></i>
								</div>
                            </fieldset>
                            
                            <fieldset class="form-group position-relative has-icon-left">
								<input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password" required>
								<div class="form-control-position">
								    <i class="fa fa-unlock"></i>
								</div>
                            </fieldset>
							
							<fieldset class="form-group position-relative has-icon-left">
								<input type="password" name="new_pass" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter new Password" required>
								<div class="form-control-position">
								    <i class="fa fa-key"></i>
								</div>
                            </fieldset>


                            <fieldset class="form-group position-relative has-icon-left">
								<input type="password" name="confirm" class="form-control form-control-lg input-lg" id="user-password" placeholder="Confirm Password" required>
								<div class="form-control-position">
								    <i class="fa fa-key"></i>
								</div>
							</fieldset>
                            

							<button type="submit" name="user_update" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Update</button>
					</form>
                        

                    
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    //echo md5("'adam'");
                        if(isset($_POST['user_update']) && $_POST['new_pass']==$_POST['confirm']){

                            $name = $_POST['name'];
                            $password = $_POST['password'];
                            $new_pass = $_POST['new_pass'];
                           

                            $genuine = $us->authenticate($_SESSION['phone'], md5("'{$password}'"));
                            
                            if($genuine){

                                $us->update($us->__auth_table, ['name', 'password'], [$name, md5("'{$new_pass}'")], [$us->__auth_column],[$_SESSION['phone']] );
                                $_SESSION['name'] = $name;

                                //TODO Redirect back to The last Page
                                $us->redirect($redir[$_SESSION['role']]);
                                

                                
                            }else{
                                echo"<script>
                                    alert('Invalid Password');
                                </script>";
                            }

                            

                            //$us->update($table, ['name']);

                            
                            //if()
                            //$us->reset_password($_SESSION['phone'], 'a', "'$_POST['password']'");

                        }

                        
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- // Options section end -->

<!-- Confirm option section start -->

<!-- // Confirm option section end -->


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END PAGE LEVEL JS-->




    
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/extensions/sweetalert.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
   
    
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/extensions/sweet-alerts.js"></script>
    <!-- END PAGE LEVEL JS-->



  </body>
</html>