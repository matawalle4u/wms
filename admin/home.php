<?php
  session_start();
  $_SESSION['page'] = __FILE__;
  
  include('../modules/Compl_Classes.php');  
  $us = new Admin('admin', 'phone', 'crm');
  $us->logout('index.php', 'System');
  $wh = new Warehouse();


  
  $email = $_SESSION['phone'];


  $users = $us->join_get('users', 'privelages', 'user_id', 'user' , ['user_id','user', 'name', 'phone', 'role', 'status', 'actions', 'last_login'], [], [], 'many');
  $users_names = array();
  $users_ids = array();

  foreach($users as $user){
    array_push($users_names, $user['name']);
    array_push($users_ids, $user['user_id']);
  }


  $warehouses = $wh->view_warehouse(['warehouse_id', 'warehouse_name'], [], [], 'many');

  $warehouse_names = array();
  $warehouse_ids = array();

  foreach($warehouses as $item){
    array_push($warehouse_names, $item['warehouse_name']);
    array_push($warehouse_ids, $item['warehouse_id']);
  }



  $damages = $us->get('damages', ['damage_id'], [], [], 'many');

  //$stocks = $us->get('stocks', ['stock_id'], [], [], 'many');

  $prod_warehouse = $us->join_get('stocks', 'products', 'product', 'product_id', ['description', 'category', 'quantity', 'status','last_stocked'],[], [], 'many');

  $stock_details = array();
  $ttl_prods =0;
  foreach($prod_warehouse as $prd){
    
    if($prd['quantity']>0){

      array_push($stock_details, $prd['description']);
      $ttl_prods+=$prd['quantity'];
      //array_push($stock_details, $prd['warehouse']);
    }
  }


  //}


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
    <title>System Admin</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="../image/x-icon" href="app-assets/images/ico/favicon.ico">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    BEGIN VENDOR CSS -->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END Custom CSS-->
    <script type="text/javascript" src="../my_custom_js.js"></script>
    
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark bg-primary navbar-shadow navbar-brand-center">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="html/ltr/vertical-compact-menu-template/index.html">
                
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a></li>
            </ul>

            <ul class="nav navbar-nav float-right">         
              
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-default badge-danger badge-default badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-default badge-danger float-right m-0">5 New</span>
                  </li>
                  <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">You have new order!</h6>
                          <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading red darken-1">99% Server load</h6>
                          <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                          <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">Complete the task</h6><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading">Generate monthly report</h6><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                        </div>
                      </div></a></li>
                  <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"></i><span class="badge badge-pill badge-default badge-info badge-default badge-up">5              </span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6><span class="notification-tag badge badge-default badge-warning float-right m-0">4 New</span>
                  </li>
                  <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Margaret Govan</h6>
                          <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start.</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Bret Lezama</h6>
                          <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Tuesday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Carie Berra</h6>
                          <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-away rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Eric Alsobrook</h6>
                          <p class="notification-text font-small-3 text-muted">We have project party this saturday.</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">last month</time></small>
                        </div>
                      </div></a></li>
                  <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
                </ul>
              </li>

              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><i></i></span><span class="user-name"><?php echo $_SESSION['name'];?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="../update_profile.php"><i class="ft-user"></i> Edit Profile</a>
                    <a class="dropdown-item" href="email-application.html"><i class="ft-mail"></i> My Inbox</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item" href="?logout=true"><i class="ft-power"></i> Logout</a>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

         

          
          <li class=" nav-item"><a href="#"><i class="icon-user"></i><span class="menu-title">Users</span></a>
            <ul class="menu-content">
              <li><a  data-toggle="modal" data-target="#daniel">Add new user</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.navbars.main">Update user</a>   
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.vertical_nav.main">View users</a> 
              </li>
               
            </ul>
          </li>
          
         
          

        </ul>
      </div>
    </div>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">

          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adduser"><i class="ft-plus white"></i> New User</button>
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateuser"><i class="fa fa-pencil white"></i> Update user</button>
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newPartner"><i class="fa fa-pencil white"></i> New Partner</button>
            
            
          </div>
          
        </div>
        <div class="content-body"><!-- HTML (DOM) sourced data -->
    <section id="html">
    <!-- SUMMARY STARTS HERE -->
     <div class="row">
        <div class="col-xl-2 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                    <i class="fa fa-building info font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h5><?php echo sizeof($warehouses);?></h5>
                                <span>Warehouse</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                    <i class="fa fa-shopping-bag info font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h3><?php echo $ttl_prods;?></h3>
                                <span>Products</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                    <i class="fa fa-recycle danger font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4><?php echo sizeof($damages);?></h4>
                                <span>Damaged</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                    <i class="fa fa-credit-card success font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4>278</h4>
                                <span>Sales</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                    <i class="fa fa-money danger font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4>278</h4>
                                <span>Purchase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                    <i class="fa fa-user info font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4><?php echo sizeof($users);?></h4>
                                <span>Staffs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SUMARRY ENDS HERE -->
	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">
	                
	                <table class="table table-striped table-bordered sourced-data">
					        <thead>
					            <tr>
					                <th>S/N</th>
                          <th>Name</th>
					                <th>Role</th>
					                <th>Contact number</th>
					                <th>Status</th>
					                
                          <th>Previledges</th>
                          <th>Last logged in</th>
                          <th>Log</th>
					            </tr>
					        </thead>
					        <tbody>

                      <?php
                        foreach($users as $index=>$user){
                          $sn = $index+1;
                          if($user['status']==1){$stat_colo = "<span class='badge badge-success badge-primary'>Active</span>";}else{$stat_colo = "<span class='badge badge-danger badge-primary'>Inactive</span>";}
                          echo"<tr>";
                            echo"<td>". $sn ."</td>";
                            echo"<td>". $user['name']."</td>";
                            echo"<td>". $user['role']."</td>";
                            echo"<td>". $user['phone'] ."</td>";
                            echo"<td>". $stat_colo ."</td>";
                            echo"<td>"; echo"<ul>";foreach(explode(',', $user['actions']) as $action){echo"<li>$action</li>";}echo"</ul></td>";
                            echo"<td>". substr($user['last_login'],0,16)."</td>";
                            echo"<td><a href=\"../user_log.php?user_id={$user['user']}\">View</a></td>";
											    echo"</tr>";
                        }

                      ?>
					           
					        </tbody>
					        
					    </table>
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

    <div class="modal fade text-left" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Add user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
            <h4 class="form-section"><i class="ft-user"></i> User details</h4>
            <script type="text/javascript">

              var warehouse_names = <?php echo json_encode($warehouse_names);?>;
              var warehouse_ids = <?php echo json_encode($warehouse_ids);?>;

              generate_form(
                  ['warehouse', 'role', 'name', 'phone', 'email', 'password'],
                  ['select', 'select', 'text', 'text', 'email', 'password'],
                  [
                    warehouse_names,
                    ['Driver', 'Picker','Warehouse Manager', 'Sales Agent']
                  ], 
                  [
                    warehouse_ids,
                    ['Drvier', 'Warehouse Manager', 'Sales Agent'] 
                  ],   
                  ['Warehouse', 'Role', 'Full name', 'Phone', 'Email', 'Password']
              );

            </script>
            <button type="submit" name="user_added" class="btn btn-info"><i class="fa fa-plus"></i> Add</button>
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        
        </form>
            
            <script>
              function validate(){
                //Handle
                //alert('Hey');
                return [];
              }

              var errors = validate();
            
            </script>

          <?php 
            if(isset($_POST['user_added'])){

              $auth = new Admin('users', 'phone', 'crm');
             
              $name = $_POST['name'];
              $phone = $_POST['phone'];
              $email = $_POST['email'];
              $role = $_POST['role'];
              $password = $_POST['password'];
              $warehouse = $_POST['warehouse'];
              $status = 1;

              $columns = ['name', 'phone', 'email', 'role', 'password', 'status'];
              $values = ["'$name'", "'$phone'", "'$email'", "'$role'", "'$password'", "'$status'"];

              
              $reg = $auth->register($columns, $values);

              if($reg){

                $get_user_detail = $auth->get('users', ['user_id'], ['phone'], [$phone], 'single');
                $user_id = $get_user_detail[0]['user_id'];
                $set_warehouse = $auth->put('warehouse_users', ['user', 'warehouse','role'], ["'$user_id'", "'$warehouse'", "'$role'"]);
                $us->redirect('home.php');

                
              }else{
                echo"
                <script>alert('Error, Try again')</script>
                ";
              }


            }
          ?>
           
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
      </div>
    </div>
      
  
    


    

    


    <div class="modal fade text-left" id="updateuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Update user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->

          <form class="form-horizontal form-simple" method="post" novalidate>
							
              <script type="text/javascript">

                  var users = <?php echo json_encode($users_names);?>;
                  var ids = <?php echo json_encode($users_ids);?>;

                  generate_form(
                      ['user', 'name', 'warehouse', 'role', 'phone', 'email'],
                      ['select', 'text', 'select', 'select', 'text', 'email'],
                      [
                        users,
                        warehouse_names,
                        ['Driver', 'Picker', 'Sales Agent', 'Warehouse Manager']
                      ], 
                      [
                        ids,
                        warehouse_ids,
                        ['Driver', 'Picker', 'Sales Agent', 'Warehouse Manager']
                      ],   
                      ['User', 'Name', 'Warehouse', 'Role', 'Phone', 'Email']
                  );      
              </script>


            
                  

                
                   <center>
                   <h4 class="form-section"><i class="ft-user"></i> User Previleges</h4>
                    <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Add Users
                    
                   
                    <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Delete User
                   
                   
                    <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update user
                   
                    
                    <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account <br />

                      <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account

                      <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account


                      <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account <br />

                      <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account

                      <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account

                      <input type="checkbox" name="drawings_submitted[]" value="Location Plan/Site Plan">
                      Update User account




                </center>
                    
                 


              <br />
							<button type="submit" name="user_updated" class="btn btn-info float-right"><i class="fa fa-pencil"></i> Update</button>
						</form>



           
        </div>
        
        <?php

            //if(isset($_POST['warehouse_added'])){

              if(isset($_POST['user_updated'])){

                
                $updated_user = $_POST['user'];
                $phone = $_POST['phone'];

                $name = $_POST['name'];
                $email = $_POST['email'];
                
                


                

              }

            
        ?>
      </div>
        
      </div>
    </div>



    <footer class="footer footer-static footer-dark navbar-border navbar-shadow">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block"> </span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../app-assets/js/scripts/tables/datatables-extensions/datatables-sources.js"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>