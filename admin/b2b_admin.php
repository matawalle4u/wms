<?php
  session_start();
  
  include('../modules/Compl_Classes.php');
  //include('../modules/Orders.php');
  $us = new Admin('admin', 'phone', 'crm');
  $orderClass = new Orders();

  $us->logout('index.php', 'b2b');


  $noti = new Notifications();
  $orderClass = new Orders();

  $util = new Utils();

  $notis  = $noti->get_notification();
  $messages = $noti->get_messages();



  // if(!isset($_SESSION['phone']) || isset($_GET['logout']) || $_SESSION['role']!='b2b'){
  //   $us->logout('index.php');
  //}else{
    $email = $_SESSION['phone'];

    $configs = $us->get('product_config', ['prod_config_id', 'unit_measure', 'unit_restr'], [], [], 'manay');

    $config_details = array();
    $config_ids = array();

    foreach($configs as $item){
      array_push($config_details, $item['unit_measure'] .' [' .$item['unit_restr'] .' Allowed ]');
      array_push($config_ids, $item['prod_config_id']);
    }



    $categories = $us->get('product_category', ['prod_category_id', 'category_name', 'category_desc'], [], [], 'manay');
    
    $categ_details = array();
    $categ_ids = array();

    foreach($categories as $item){
      array_push($categ_details, $item['category_name'] .' [' .$item['category_desc'] .' ]');
      array_push($categ_ids, $item['prod_category_id']);
    }


    $orders = $us->join_get('orders', 'customers', 'customer', 'customer_id' , ['order_id','details', 'order_date', 'order_status', 'name', 'contact', 'address'], [], [], 'many');
    
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
    <title>Title here</title>
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
              
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-default badge-danger badge-default badge-up"><?php echo sizeof($notis); ?></span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-default badge-danger float-right m-0"><?php echo sizeof($notis); ?> New</span>
                  </li>

                  <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">

                      <?php
                        foreach($notis as $index=>$noti_item){
                          $date = substr($noti_item['date_of_noti'], 0, 10);
                          $time = substr($noti_item['date_of_noti'], 12,19);
                          echo"
                            <div class=\"media\">
                              <div class=\"media-left align-self-center\"><i class=\"{$noti_item['message_icon']} icon-bg-circle bg-cyan\"></i></div>
                              <div class=\"media-body\">
                                <h6 class=\"media-heading\">New {$noti_item['title']} on $date!</h6>
                                <p class=\"notification-text font-small-3 text-muted\">{$noti_item['content']}</p>
                                <small><time class=\"media-meta text-muted\" datetime=\"2015-06-11T18:29:20+08:00\">$date</time></small>
                              </div>
                            </div>
                            </a><a href=\"javascript:void(0)\">
                          ";
                        }
                      ?>
                    </a></li>

                  <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                
                </ul>
              </li>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"></i><span class="badge badge-pill badge-default badge-danger badge-default badge-up"><?php echo sizeof($messages);?></span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6><span class="notification-tag badge badge-default badge-warning float-right m-0"><?php echo sizeof($messages);?> New</span>
                  </li>
                  <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">

                      <?php 
                        foreach($messages as $index=>$message){

                          $date = substr($message['date_sent'], 0, 10);
                          $time = substr($message['date_sent'], 12,19);
                          $body = substr($message['body'], 0,25);

                          echo "
                          <div class=\"media\">
                            <div class=\"media-left\"><span class=\"avatar\"><img src=\"../src/Daniel.jpeg\" alt=\"avatar\"><i></i></span></div>
                            <div class=\"media-body\">
                              <h6 class=\"media-heading\">{$message['subject']} [{$message['name']}]</h6>
                              <p class=\"notification-text font-small-3 text-muted\">$body...</p><small>
                                <time class=\"media-meta text-muted\" datetime=\"2015-06-11T18:29:20+08:00\">$date</time></small>
                            </div>
                          </div></a><a href=\"javascript:void(0)\">
                          ";

                        }
                      ?>
                      </a></li>

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

          <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adduser"><i class="ft-plus white"></i> New User</button> -->
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProduct"><i class="fa fa-pencil white"></i> New Product</button> 
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
                                    <i class="fa fa-shopping-cart info font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h5><?php echo sizeof($orders);?></h5>
                                <span>Orders</span>
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
                          <th>Order Date</th>
					                <th>Details</th>
                          <th>Customer</th>
                          <th>Contact</th>
                          <th>Address</th>
					                <th>Status</th>
					            </tr>
					        </thead>
					        <tbody>

                      <?php
                        foreach($orders as $index=>$order){
                          $sn = $index+1;
                          if($order['order_status']=='Approved'){$stat_colo = "<span class='badge badge-success badge-primary'>Approved</span>";}else{$stat_colo = "<span class='badge badge-danger badge-primary'><a href=>{$order['order_status']}</a></span>";}
                          echo"<tr>";
                            echo"<td>". $sn ."</td>";
                            echo"<td>". substr($order['order_date'],0,16)."</td>";
                            //Decompose details here

                            $details = $orderClass->decompose($order['details']);

                            $products = $details[0];
                            $quantities = $details[1];
                            $prices = $details[2];
                            $selling_price = $details[3];
                            $order_type = $details[4];
                            $unit = $details[5];
                            $product_id = $details[6];

                            
                            echo"<td><ol>";
                            foreach($details[0] as $key=>$value){
                              echo '<li>' .$details[0][$key] .' '. $details[1][$key] . $details[5][$key] .'</li>';
                            }

                            echo"</ol></td>";


                            //echo"<td>". $products."</td>";
                            echo"<td>". $order['name']."</td>";
                            echo"<td>". $order['contact']."</td>";
                            echo"<td>". $order['address']."</td>";
                           
                            echo"<td>". $stat_colo ."</td>";
                            
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
              generate_form(
                  ['name', 'phone', 'email', 'role', 'password'],
                  ['text', 'text', 'email', 'select','password'],
                  [
                    ['Driver', 'Warehouse Manager', 'Sales Agent']
                  ], 
                  [
                    ['Drvier', 'Warehouse Manager', 'Sales Agent'] 
                  ],   
                  ['Full name', 'Phone', 'Email', 'Role', 'Password']
              );

            </script>
            <button type="submit" name="user_added" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Register</button>
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
              $status = 1;

              $columns = ['name', 'phone', 'email', 'role', 'password', 'status'];
              $values = ["'$name'", "'$phone'", "'$email'", "'$role'", "'$password'", "'$status'"];

              //echo "$name $phone $email $role $password ";
              $reg = $auth->register($columns, $values);
              if($reg){
                $us->redirect('admin_home.php');
              }else{
                echo"
                <script>alert('Error, Try again')</script>
                ";
              }


            }
          ?>
           
        </div>
        <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        
        </div>
      </div>
      </div>
    </div>
      
  
    


    

    <div class="modal fade text-left" id="newPartner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Create Partner</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->

          <form class="form-horizontal form-simple" method="post" novalidate>
							
              <script type="text/javascript">

                  generate_form(
                      ['partner', 'partnership', 'part_code', 'part_reg_code', 'email', 'contact','address','category', 'password', 'repeat'],
                      ['text', 'select', 'text', 'text','email','text', 'text', 'select', 'password', 'password'],
                      [
                        ['Supplier', 'Customer', 'Supplier&Customer'],
                        ['B2B', 'Normal']
                        
                      ], 
                      [
                        ['supplier', 'customer', 'supplier_customer'],
                        ['b2b', 'norm']
                        
                      ],   
                      ['Partner', 'Partnership Type', 'Partner Code', 'Partner Reg. Code', 'Email', 'Contact', 'Address', 'Category', 'Password', 'Confirm']
                  );      
              </script>
							<button type="submit" name="customer_added" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Register</button>
						</form>



           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            //if(isset($_POST['warehouse_added'])){

              if(isset($_POST['customer_added'])){

                $auth = new Admin('customers', 'email', 'crm');

                $name = $_POST['partner'];
                $email = $_POST['email'];
                $code = $_POST['part_code'];
                $reg_code = $_POST['part_reg_code'];
                $contact = $_POST['contact'];
                $address = $_POST['address'];
                $password = $_POST['password'];
                $confirm = $_POST['repeat'];
                $category = $_POST['category'];
                $partnership = $_POST['partnership'];
                $status =1;

                $values = ["'$name'", "'$code'", "'$reg_code'", "'$email'", "'$contact'", "'$address'", "'$password'", "'$category'","'$partnership'", "'$status'"];
                $columns = ['name', 'customer_code', 'cust_reg_code', 'email', 'contact', 'address', 'password', 'category','type', 'status'];




                $reg = $auth->register($columns, $values);

                if($reg){
                  echo"hurray";
                }else{
                  echo"Sorry";
                }

              }

            
        ?>
      </div>
        
      </div>
    </div>



    <div class="modal fade text-left" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Add Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->

          <form class="form-horizontal form-simple" method="post" ENCTYPE="multipart/form-data">
							
              <script type="text/javascript">


                  var configs = <?php echo json_encode($config_details);?>;
                  var config_ids = <?php echo json_encode($config_ids);?>;   
                  
                  var categs = <?php echo json_encode($categ_details);?>;
                  var categ_ids = <?php echo json_encode($categ_ids);?>; 

                  generate_form(
                      ['file', 'description', 'category', 'config', 'product_code'],
                      ['file', 'text', 'select', 'select', 'text'],
                      [
                        categs,configs
                      ], 
                      [
                        categ_ids, config_ids
                      ],   
                      ['Picture', 'Description', 'Category', 'Configuration', 'Product Code']
                  );      
              </script>
							<button type="submit" name="product_added" class="btn btn-info btn-sm"><i class="ft-unlock"></i> Add</button>
						</form>



           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            if(isset($_POST['product_added'])){
              $desc = $_POST['description'];
              $cat = $_POST['category'];
              $conf = $_POST['config'];
              $pr_cod = $_POST['product_code'];

              $pic = $util->file_upload('file', "{$_SESSION['role']}Admin", "$desc", "{$_SESSION['role']}Admin");


              $table = 'products';
              $columns = array("description","category","config","product_code", "img_src");
              $values = ["'$desc'", "'$cat'", "'$conf'", "'$pr_cod'", "'$pic'"];
              //array $columns, array $values

              
              $us->put($table, $columns, $values);
             
              echo"<h1>$pic</h1>";
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

    <script type="text/javascript" src="../my_custom_js.js"></script>
    
  </body>
</html>