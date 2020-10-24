<?php
  session_start();
  $_SESSION['page'] = __FILE__;
  
  include('../modules/Compl_Classes.php');  
  $us = new Admin('admin', 'phone', 'crm');
  $us->logout('index.php', 'System');
  $wh = new Warehouse();
  
  $noti = new Notifications();
  $orderClass = new Orders();

  $notis  = $noti->get_notification();
  $messages = $noti->get_messages();

  
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



  
  //$stocks = $us->get('stocks', ['stock_id'], [], [], 'many');

  $prod_warehouse = $us->join_get('stocks', 'products', 'product', 'product_id', ['description','config', 'category', 'quantity', 'status','last_stocked'],[], [], 'many');

  $stock_details = array();
  $ttl_prods =0;
  foreach($prod_warehouse as $prd){
    
    if($prd['quantity']>0){

      //array_push($stock_details, $prd['description']);
      $ttl_prods+=$prd['quantity'];
      //array_push($stock_details, $prd['warehouse']);
    }
  }


  $sales = $us->get('sales', ['invoice','products_details', 'sales_date','seller'],[], [], 'many');
  $purchase = $us->join_get('purchases','suppliers', 'supplier', 'supplier_id', ['invoice','supplier_name','products_details', 'purchase_date'],[], [], 'many');

  

  $prod_warehouse = $us->join_get('stocks', 'products', 'product', 'product_id', ['description', 'rack', 'config','category', 'quantity', 'status', 'stocker', 'last_stocked'],[], [], 'many');

    $stock_details = array();
    $ttl_prods =0;
    foreach($prod_warehouse as $prd){

      if($prd['quantity']>0){

       
        $ttl_prods+=$prd['quantity'];
        array_push($stock_details, $prd['description']);
        //array_push($stock_details, $prd['warehouse']);
        
      }


      
    }


    $warehouses = $us->join_get('warehouse_users', 'warehouses', 'warehouse', 'warehouse_id' , ['warehouse_id', 'warehouse_name'], [], [], 'many');

    $warehouse_names = array();
    $warehouse_ids = array();

    foreach($warehouses as $item){
      array_push($warehouse_names, $item['warehouse_name']);
      array_push($warehouse_ids, $item['warehouse_id']);
    }

    
    $racks = $us->join_get('racks', 'warehouses', 'rack_warehouse', 'warehouse_id' , ['rack_id','rack_row','rack_column','rack_level','rack_position', 'warehouse_name'], [], [], 'many');
    $rack_names = array();
    $rack_ids = array();

    foreach($racks as $rack){
      $details = $rack['warehouse_name'].' [Row '.$rack['rack_row']. ' Column '.$rack['rack_column']. ' Level ' .$rack['rack_level'] .' '.$rack['rack_position'].']';
      
        if(in_array($rack['warehouse_name'], $warehouse_names)){
          array_push($rack_names, $details);
        }
      }



    $requests = $us->join_get('requests', 'warehouses', 'warehouse', 'warehouse_id' , ['request_id','warehouse_name','products_details','request_date','status'], ['status'], ['Pending'], 'many');

    $damages = $us->join_get('damages','stocks','stock','stock_id', ['damage_id','stock','damage_quantity','details','damaged_date','damages_recorder'], [], [], 'many');

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
    <script src="../qrcode\js/jquery.js"></script>
    
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
          <li class=" nav-item"><a href="#"><i class="fa fa-building"></i><span class="menu-title">Warehouse</span></a>
            <ul class="menu-content">
              <li><a  data-toggle="modal" data-target="#daniel">Add new warehouse</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.navbars.main">Update Warehouse</a>   
              </li>

              <li><a class="menu-item" href="#xyz" data-i18n="nav.navbars.main">View Warehouse</a>   
              </li>


              <li><a class="menu-item" href="#" data-i18n="nav.vertical_nav.main">Create Zone</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.vertical_nav.main">Update Zone</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.vertical_nav.main">Create Rack</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.vertical_nav.main">Update Rack</a> 
              </li>


              <li><a class="menu-item" href="#" data-i18n="nav.navbars.nav_hide_on_scroll.main">Hide on Scroll</a>
                    <ul class="menu-content">
                      <li><a class="menu-item" href="navbar-hide-on-scroll-top.html" data-i18n="nav.navbars.nav_hide_on_scroll.nav_hide_on_scroll_top">Hide on Scroll Top</a>
                      </li>
                      <li><a class="menu-item" href="navbar-hide-on-scroll-bottom.html" data-i18n="nav.navbars.nav_hide_on_scroll.nav_hide_on_scroll_bottom">Hide on Scroll Bottom</a>
                      </li>
                    </ul>
              </li>


            </ul>
          </li>

          
        </ul>


        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title">Products</span></a>
            <ul class="menu-content">
              <li><a  data-toggle="modal" data-target="#adduser">Add new</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.navbars.main">Update</a>   
              </li>
              <li><a onclick="display_div('stocks_table')" class="menu-item" href="#" data-i18n="nav.vertical_nav.main">View Stock</a> 
              </li>

              <li><a onclick="display_div('damages_table')" class="menu-item" href="#" data-i18n="nav.vertical_nav.main">View damages</a> 
              </li>
               
            </ul>
          </li>
        </ul>

      
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="#"><i class="fa fa-credit-card"></i><span class="menu-title">Sales</span></a>
            <ul class="menu-content">
              
              <li><a onclick="display_div('sales_table')" class="menu-item" href="#" data-i18n="nav.vertical_nav.main">View Sales</a> 
              </li>

              
               
            </ul>
          </li>
        </ul>



        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="#"><i class="fa fa-handshake-o"></i><span class="menu-title">Requests</span></a>
            <ul class="menu-content">
              
              <li><a class="menu-item" href="#" data-i18n="nav.navbars.main">Review</a>   
              </li>
              <li><a onclick="display_div('requests_table')" class="menu-item" href="#" data-i18n="nav.vertical_nav.main">View requests</a> 
              </li>
               
            </ul>
          </li>
        </ul>

        <script>
          //Onclick Launch modal

         $(document).ready(function(){
            
            $('#user_table').hide();
            $('#sales_table').hide();
            $('#stocks_table').hide();
            $('#requests_table').hide();
            $('#damages_table').hide();
            $('#purchases_table').hide();

          });

         

          

          function handle_modal(modalID, $id){
            //var myBookId = $(this).data($id);
            //$(".modal-body #bookId").val(myBookId);
            $(modalID).modal();
          }

          function display_div(id){

            var table_ids = ["user_table", "sales_table", "stocks_table", "requests_table","damages_table", "purchases_table"];
            $.each(table_ids, function(index){
              
              if(table_ids[index]!=id){
                $('#'+table_ids[index]).hide();
                //document.write(table_ids[index]);
              }else{
                $('#'+id).show();
              }
            });

            

          
          }


          
          
        </script>




        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="#"><i class="icon-user"></i><span class="menu-title">Users</span></a>
            <ul class="menu-content">
              <li><a onClick="handle_modal(adduser)">Add new user</a> 
              </li>
              <li><a onclick="display_div('user_table')">Update user</a>   
              </li>
              <li><a onclick="display_div('user_table')">View users</a> 
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
       <?php //print_r($noti->get_notification(1, 'Admin'));?>

       <script type="text/javascript">

          var whnos = <?php echo sizeof($warehouses);?>;
          var products =<?php echo $ttl_prods;?>;
          var damages = <?php echo sizeof($damages);?>;
          var ttl_sales = <?php echo sizeof($sales);?>;
          var reqs = <?php echo sizeof($requests);?>;
          var purchases = <?php echo sizeof($purchase);?>

          // summary_icons(
          //   ["Warehouse", "Products", "Damaged", "Sales", "Request", "Purchases"],
          //   ["building", "shopping-bag", "recycle","credit-card", "handshake-o", "money"],
          //   [whnos, products, damages,ttl_sales,reqs,purchases],
          //   ["info", "info", "danger", "success", "info","danger"]
          //   );

       </script>
       
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
                                        <h4><?php echo sizeof($sales);?></h4>
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
                                    <i class="fa fa-handshake-o info font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4><?php echo sizeof($requests);?></h4>
                                <span>Request</span>
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
                                        <h4><?php echo sizeof($purchase);?></h4>
                                <span>Purchases</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SUMARRY ENDS HERE -->
	<div id="user_table" class="row">
	    <div class="col-12">
	        <div class="card">
	            
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">

                  <h4>Users [<?php echo sizeof($users);?>]</h4>
              
	                
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




  <div id="sales_table" class="row">
	    <div class="col-12">
	        <div class="card">
	            
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">    
              <h4>Sales [<?php //echo sizeof($sales);?>] <?php //echo $_GET['id'];?> </h4>
              <hr>

              <table class="table table-striped table-bordered sourced-data">
					        <thead>
					            <tr>
					                <th>S/N</th>
                          <th>Date</th>
					                <th>Products</th>
                          <th>Total</th>
                          <th>Invoice</th>
                          <th>Seller</th>  
					            </tr>
					        </thead>
					        <tbody>

                      <?php
                        
                        foreach($sales as $index=>$sale){

                          $sn = $index+1;
                          $seller = $us->get('users', ['name'],['user_id'], [$sale['seller']], 'single');
                          $details = $orderClass->decompose($sale['products_details']);
                          
                          echo"<tr>";
                            echo"<td>". $sn ."</td>";
                            echo"<td>". substr($sale['sales_date'], 0,16)."</td>";
                            echo"<td><ul>";
                            $ttl_items =0;
                            foreach($details[0] as $key=>$value){
                              echo '<li>' .$details[1][$key] .' ' .$details[3][$key] .' of '. $details[0][$key] .'</li>';
                              $ttl_items +=$details[1][$key];
                            }
                            echo"</ul></td>";
                            echo"<td>". $ttl_items ."</td>"; 
                            echo"<td>". $sale['invoice'] ."</td>"; 
                            echo"<td><span class='badge badge-success'>". $seller[0]['name'] ."</span></td>"; 
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
  

  <div id="stocks_table" class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">
              <h4>Stock [Total Items <?php echo $ttl_prods;?>]</h4>
              <hr>

              <table class="table table-striped table-bordered sourced-data">
					        <thead>
					            <tr>
					                <th>Name</th>
					                <th>Category</th>
                          <th>Date Stocked</th>
                          <th>Stocked By</th>
					                <th>Unit Measure</th>
					                <th>Avail. Qty</th>
                          <th>Rack</th>
					            </tr>
					        </thead>
					        <tbody>
                      <?php
                        foreach($prod_warehouse as $index=>$record){
                          
                          $stocker = $us->get('users', ['name'],['user_id'],[$record['stocker']], 'single');
                          $category_name = $us->get('product_category', ['category_name'],['prod_category_id'],[$record['category']], 'single');
                          $category_name = $us->get('product_category', ['category_name'],['prod_category_id'],[$record['category']], 'single');
                          $unit_measure = $us->get('product_config', ['unit_measure'],['prod_config_id'],[$record['config']], 'single');

                          $location = $us->join_get('racks', 'warehouses','rack_warehouse', 'warehouse_id', ['warehouse_name','rack_row','rack_column', 'rack_level','rack_position'], ['rack_id'], [$record['rack']], 'single');
                          
                          echo"
                            <tr>
                              <td>{$record['description']}</td>
                             
                              <td>{$category_name[0]['category_name']}</td>".
                              "<td>". substr($record['last_stocked'], 0, 16) ."</td>".
                              "<td>{$stocker[0]['name']}</td>".
                              "<td>{$unit_measure[0]['unit_measure']}</td>".
                              "<td>{$record['quantity']}</td>".
                              "<td>{$location[0]['warehouse_name']} Row:{$location[0]['rack_row']}, Col:{$location[0]['rack_column']}, {$location[0]['rack_level']}, {$location[0]['rack_position']}</td>".

                             "</tr>";
                        }
                     
                      ?>

					        </tbody>
					    </table>
              
					</div>
	            </div>
	        </div>
	    </div>
	</div>




  <div id="requests_table" class="row">
	    <div class="col-12">
	        <div class="card">
	            
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">
                    
              <h4>Requests [<?php echo sizeof($requests);?>]</h4>
              <hr>
              

              <table class="table table-striped table-bordered sourced-data">
					        <thead>
					            <tr>
					                <th>S/N</th>
                          <th>Request date</th>
                          <th>Warehouse</th>
					                <th>Products</th>
                          <th>Status</th>
                          <th>Adjust Qty</th>
                          
					                
					            </tr>
					        </thead>
					        <tbody>

                      <?php
                        
                        foreach($requests as $index=>$req){
                          $sn = $index+1;
                          
                          $details = $orderClass->decompose($req['products_details']);
                          //print_r($details);
                          
                          echo"<tr>";
                            echo"<td>". $sn ."</td>";
                            echo"<td>". substr($req['request_date'], 0,16)."</td>";
                            echo"<td>". $req['warehouse_name']."</td>";
                            echo"<td><ul>";
                            echo"
                              <table>
                                <tr>
                                  <th>S/N</th>
                                  <th>Product</th>
                                  <th>Qty</th>
                                  <th>Unit</th>
                                  
                                </tr>
                              ";
                              foreach($details[0] as $key=>$value){$sn = $key+1; echo '<tr><td>'.$sn.'</td><td>'.$details[0][$key] .'</td><td>'.$details[1][$key] .' </td>' .'<td>'.$details[2][$key] .'</td></tr>';}
                              
                            echo"</table></td>";
                            
                            echo"<td><span class='badge badge-danger'>". $req['status'] ."</span></td>"; 

                            echo"<td>";
                            echo "<button type=\"submit\" onclick=\"handle_modal(request_adjust)\" class=\"btn btn-info btn-sm\"> Adjust</button></td>";

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




  <div id="damages_table" class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">     
              <h4><span class='badge badge-danger'>Damages</span> [<?php echo sizeof($damages);?>]</h4>
              <hr>
              <table class="table table-striped table-bordered sourced-data">
					        <thead>
					            <tr>
					                <th>S/N</th>
                          <th>Damage date</th>
                          <th>Product</th>
                          <th>Details</th>
					                <th>Qty</th>
                          <th>Recorder</th>
                          <th>Rack</th>
					            </tr>
					        </thead>
					        <tbody>
                      <?php
                        foreach($damages as $index=>$damage){
                          $sn = $index+1;

                          $recorder = $us->get('users', ['name'],['user_id'],[$damage['damages_recorder']], 'single');
                          $location = $us->join_get('stocks', 'racks','rack', 'rack_id', ['product', 'stock_id','rack_warehouse', 'rack_row', 'rack_column', 'rack_level','rack_zone','rack_position'], ['stock_id'], [$damage['stock']], 'single');
                          
                          $warehouse = $us->get('warehouses', ['warehouse_name'],['warehouse_id'],[$location[0]['rack_warehouse']], 'single');
                          $product = $us->get('products', ['description'],['product_id'],[$location[0]['product']], 'single');
                          
                          
                          echo"<tr class=\"bg-danger white\">";
                            echo"<td>". $sn ."</td>";
                            echo"<td>". substr($damage['damaged_date'], 0,16)."</td>";
                            echo"<td>".$product[0]['description']."</td>";
                            echo"<td>". $damage['details']."</td>";
                            echo"<td>". $damage['damage_quantity']."</td>";
                            echo"<td>". $recorder[0]['name']."</td>";
                            echo "<td>{$warehouse[0]['warehouse_name']}, Row:{$location[0]['rack_row']}, Col:{$location[0]['rack_column']}, {$location[0]['rack_level']}, {$location[0]['rack_position']}</td>";
                           
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



  <div id="purchases_table" class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-content collpase show">
	                <div class="card-body card-dashboard">     
              <h4>Purchases [<?php echo sizeof($purchase);?>]</h4>
              <hr>
              <table class="table table-striped table-bordered sourced-data">
					        <thead>
					            <tr>
					                <th>S/N</th>
                          <th>Purchase date</th>
                          <th>Invoice</th>
                          <th>Supplier</th>
					                <th>Products details</th> 
					            </tr>
					        </thead>
					        <tbody>
                      <?php
                        foreach($purchase as $index=>$req){
                          $sn = $index+1;
                          $details = $orderClass->decompose($req['products_details']);
                          echo"<tr>";
                            echo"<td>". $sn ."</td>";
                            echo"<td>". substr($req['purchase_date'], 0,16)."</td>";
                            echo"<td>". $req['invoice']."</td>";
                            echo"<td>". $req['supplier_name']."</td>";
                            echo"
                            <td><ul>";
                              echo"
                              <table>
                                <tr>
                                  <th>S/N</th>
                                  <th>Product</th>
                                  <th>Qty</th>
                                  <th>Unit</th>
                                </tr>
                              ";
                              foreach($details[0] as $key=>$value){$sn = $key+1; echo '<tr><td>'.$sn.'</td><td>'.$details[0][$key] .'</td><td>'.$details[1][$key] .' </td>' .'<td>'.$details[3][$key] .'</td></tr>';}
                              echo"</table>
                            </td>";
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




    <div class="modal fade text-left" id="request_adjust" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Review Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
            <script>
              //document.write(myBookId);
            </script>
            
            
            <ol>
              <li>
              <select required>
              <option>Status</option>
              <option>Pending</option>
              <option>Cancel</option>
              <option>Approve</option>
            </select>
          </li>
          </ol>



            <?php

              $requests = $us->join_get('requests', 'warehouses', 'warehouse', 'warehouse_id' , ['request_id','warehouse_name','products_details','request_date','status'], ['status', 'request_id'], ['Pending', '1'], 'many');


              foreach($requests as $index=>$req){

                $details = $orderClass->decompose($req['products_details']);
                echo"<ol start=2>";
                foreach($details[0] as $key=>$value){
                  $sn = $key+1;
                  echo "<li><input type=text value=\"{$details[0][$key]} ({$details[2][$key]})\" readonly> <input type=text value=\"{$details[1][$key]}\"></li>";
                  
                }

                echo"</ol>";
                


              }

            ?>

            

            <br /><br />
            <button type="submit" name="user_added" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn grey btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
        
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