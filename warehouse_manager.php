<?php
  session_start();
  
  include('modules/Compl_Classes.php');  
  $us = new Admin('users', 'phone', 'crm');
  $us->logout('index.php', 'Warehouse Manager');

  $wh = new Warehouse();

  $zones = $us->get('warehouse_zones', ['zone_id', 'zone_name'], [], [], 'many');

  $zone_names = array();
  $zone_ids = array();

  foreach($zones as $zoone){
    array_push($zone_names, $zoone['zone_name']);
    array_push($zone_ids, $zoone['zone_id']);
  }


    
  //$warehouses = $us->get('warehouses', ['warehouse_id', 'warehouse_name'], [], [], 'many');
  $warehouses = $wh->view_warehouse(['warehouse_id', 'warehouse_name'], [], [], 'many');

  $warehouse_names = array();
  $warehouse_ids = array();

  foreach($warehouses as $item){
    array_push($warehouse_names, $item['warehouse_name']);
    array_push($warehouse_ids, $item['warehouse_id']);
  }


  $products = $us->get('products', ['product_id', 'description'], [], [], 'many');

  $product_names = array();
  $product_ids = array();

  foreach($products as $product){
    array_push($product_names, $product['description']);
    array_push($product_ids, $product['product_id']);
  }

    
  $racks = $us->join_get('racks', 'warehouses', 'rack_warehouse', 'warehouse_id' , ['rack_id','rack_row','rack_column','rack_level','rack_position', 'warehouse_name'], [], [], 'many');
  $rack_names = array();
  $rack_ids = array();

  foreach($racks as $rack){
    $details = $rack['warehouse_name'].' [Row '.$rack['rack_row']. ' Column '.$rack['rack_column']. ' Level ' .$rack['rack_level'] .' '.$rack['rack_position'].']';
      
      if(in_array($rack['warehouse_name'], $warehouse_names)){
        array_push($rack_names, $details);
        array_push($rack_ids, $rack['rack_id']);
      }
  }


  $users = $us->get('users', ['user_id', 'name', 'phone', 'role', 'status'], [], [], 'many');

  $users_names = array();
  $users_ids = array();

  foreach($users as $user){

    if($user['user_id'] !=$_SESSION['user_id'] && $user['status'] !=0){
      $details = $user['name']. ' ('. $user['role']. ' '.$user['phone'].')';

      array_push($users_names, $details);
      array_push($users_ids, $user['user_id']);

    }
      
  }

    $damages = $us->get('damages', ['damage_id'], [], [], 'many');

    $finishing = $us->get('stocks', ['stock_id'], ['quantity'], [0], 'many');

    $prod_warehouse = $us->join_get('stocks', 'products', 'product', 'product_id', ['description', 'category', 'quantity', 'stocker', 'status','last_stocked'],[], [], 'many');

    $stock_details = array();
    $ttl_prods =0;
    foreach($prod_warehouse as $prd){

      if($prd['quantity']>0){

       
        $ttl_prods+=$prd['quantity'];
        array_push($stock_details, $prd['description']);
        //array_push($stock_details, $prd['warehouse']);
        
      }


      
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
    <title>Warehouse Admin Page</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    BEGIN VENDOR CSS -->
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script type="text/javascript" src="my_custom_js.js"></script>
    
    <!-- END Custom CSS-->
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

              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><i></i></span><span class="user-name"><?php echo $_SESSION['name']; ?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="update_profile.php"><i class="ft-user"></i> Edit Profile</a>
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

    <script>

      //load_menu(menu_icon, main,sub_menu, hrefs);

      //load_menu([''], ['Mess'],[['A'], ['B']], [['', '', '']]);
    
    </script>


    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="#"><i class="icon-folder"></i><span class="menu-title" data-i18n="nav.category.general">Warehouse</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="#" data-i18n="nav.color_palette.main">Add warehouse</a> 
              </li>
              <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.main">Add Rack</a>  
              </li>

              <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.main">Add product</a>  
              </li>
              

            </ul>
          </li>
        </ul>


      
      </div>
    </div>

    <div class="app-content content">
      <div class="content-wrapper">
        
        <div class="content-body"><!-- HTML (DOM) sourced data -->
    <section id="html">
    <!-- SUMMARY STARTS HERE -->
        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#addwharehouse" href="#">New warehouse</a>
            </li>

            <li class="breadcrumb-item"><a href="warehouse_list.php">Warehouse list</a>
            </li>


            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#updatewarehouse" href="#">Update warehouse</a>
            </li>
            <li class="breadcrumb-item"> <a data-toggle="modal" data-target="#addstaff" href="#">Add Staff</a>
            </li>
            <li class="breadcrumb-item"> <a data-toggle="modal" data-target="#assignStaffWarehouse" href="#">Assign Staff</a>
            </li>
            <li class="breadcrumb-item"> <a data-toggle="modal" data-target="#addrack" href="#">New Rack</a>
            </li>
            <li class="breadcrumb-item"> <a data-toggle="modal" data-target="#addproduct" href="#">New Product</a>
            </li>

            <li class="breadcrumb-item"> <a data-toggle="modal" data-target="#addStock" href="#">Add Stock</a>
            </li>

            
            


            

        </ol>

       

     <div class="row">
          <!-- <script>
            summary_icons([''],[''],[]);
          </script> -->
          
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
                                    <i class="fa fa-list info font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h3><?php echo sizeof($warehouses);?></h3>
                                <span>Racks</span>
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
                                    <i class="fa fa-shopping-cart success font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4>278</h4>
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
                                        <h4><?php echo sizeof($finishing);?></h4>
                                <span>Finished</span>
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
                                    <i class="fa fa-trash danger font-large-2 float-left"></i>
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
                                    <i class="fa fa-chevron-down warning font-large-2 float-left"></i>
                                </div>
                            <div class="media-body text-right">
                                        <h4><?php echo sizeof($finishing);?></h4>
                                <span>Finishing</span>
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
					                <th>Name</th>
					                <th>Location</th>
					                <th>Category</th>
					                <th>Date Stcoked</th>
					                <th>Unit Measure</th>
					                <th>Available Quantity</th>
					            </tr>
					        </thead>
					        <tbody>

                  <?php
                        foreach($prod_warehouse as $index=>$record){
                          //$ware_name = $us->get('warehouses', ['warehouse_name', 'warehouse_address'], ['warehouse_id'], [$record['warehouse']], 'single');
                          //$zone_name = $us->get('warehouse_zones', ['zone_name'], ['zone_warehouse'], [$record['warehouse']], 'single');
                          
                          $stocker = $us->get('users', ['name'],['user_id'],[$record['stocker']], 'single');
                          $category_name = $us->get('product_category', ['category_name'],['prod_category_id'],[$record['category']], 'single');
                          
                          $category_name = $us->get('product_category', ['category_name'],['prod_category_id'],[$record['category']], 'single');
                          
                          echo"
                            <tr>
                              <td>{$record['description']}</td>
                             
                              <td>{$category_name[0]['category_name']}</td>".
                              "<td>". substr($record['last_stocked'], 0, 16) ."</td>".
                              "<td>{$stocker[0]['name']}</td>".
                              "<td>Measurement</td>".
                              "<td>{$record['quantity']}</td>
                            </tr>";
                        }
                     
                      ?>

					        </tbody>
					        <!-- <tfoot>
					            <tr>
					                <th>Name</th>
					                <th>Position</th>
					                <th>Office</th>
					                <th>Age</th>
					                <th>Start date</th>
					                <th>Salary</th>
					            </tr>
					        </tfoot> -->
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

    
    


    <div class="modal fade text-left" id="addwharehouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Add Wharehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">

          <script type="text/javascript">

              generate_form(
                  ['name', 'address'],
                  ['text', 'textarea'],
                  [], 
                  [],   
                  ['Warehouse Name', 'Warehouse Address']
              );
             
          </script>
            

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Add" name="warehouse_added">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            if(isset($_POST['warehouse_added'])){

                $name = $_POST['name'];
                $address = $_POST['address'];

                $added = $wh->create_ware_house(["'$name'", "'$address'"]);

                if($added){
                  $us->redirect('warehouse_manager.php');
                }else{
                  echo "errr";
                  //0020 3169 62
                }

                //echo $name .$address;

            }
        ?>
      </div>
        
      </div>
    </div>


    <div class="modal fade text-left" id="updatewarehouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Update Wharehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">


          <script type="text/javascript">

            var warehouse_names = <?php echo json_encode($warehouse_names);?>;
            var warehouse_ids = <?php echo json_encode($warehouse_ids);?>;


            generate_form(
                ['warehouse', 'name', 'address'],
                ['select', 'text', 'textarea'],
                [
                  warehouse_names
                  
                ], 
                [
                  warehouse_ids,
                  
                ],   
                ['Warehouse', 'Name', 'Address']
            );      
            </script>

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Save" name="warehouse_updated">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            if(isset($_POST['warehouse_added'])){

                $name = $_POST['name'];
                $address = $_POST['address'];

                echo $name .$address;

            }
        ?>
      </div>
        
      </div>
    </div>
    

    



    <div class="modal fade text-left" id="assignStaffWarehouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Assign Staff To Warehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">


          <script type="text/javascript">

            var staff_names = <?php echo json_encode($users_names);?>;
            var staff_ids = <?php echo json_encode($users_ids);?>;


            generate_form(
                ['staff', 'warehouse', 'role'],
                ['select', 'select','select'],
                [
                  staff_names,
                  warehouse_names,
                  ['Warehouse Supervisor']
                  
                ], 
                [
                  staff_ids,
                  warehouse_ids,
                  ['Warehouse Supervisor']
                  
                  
                ],   
                ['Staff', 'Warehouse', 'Role']
            );      
            </script>

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Save" name="staff_assigned">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            if(isset($_POST['staff_assigned'])){

                // $user = $_POST['staff'];
                // $warehouse = $_POST['warehouse'];
                // $role = $_POST['role'];

                $assigned = $us->put('warehouse_users',['user', 'warehouse', 'role'],["'{$_POST['staff']}'", "'{$_POST['warehouse']}'", "'{$_POST['role']}'"]);
                if($assigned){
                  echo"sxxxx";
                }else{
                  echo "errrr";
                }

            }
        ?>
      </div>
        
      </div>
    </div>






    <div class="modal fade text-left" id="addrack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Create Rack</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">

          <script type="text/javascript">

              var zoness_n = <?php echo json_encode($zone_names);?>;
              var zoness_id = <?php echo json_encode($zone_ids);?>;

              generate_form(
                  ['warehouse', 'row', 'column', 'level', 'zone', 'position'],
                  ['select', 'text', 'text', 'text', 'select', 'select'],
                  [
                    warehouse_names,
                    zoness_n,
                    ['Left', 'Right', 'Middle']
                  ], 
                  [
                    warehouse_ids,
                    zoness_id,
                    ['Left', 'Right', 'Middle']
                  ],   
                  ['Warehouse', 'Row', 'Column', 'Level', 'Zone', 'Position']
              );      
          </script>

            

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Add" name="rack_added">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            if(isset($_POST['rack_added'])){

                $warehouse = $_POST['warehouse'];
                $row = $_POST['row'];
                $column = $_POST['column'];
                $level = $_POST['level'];
                $zone = $_POST['zone'];
                $position = $_POST['position'];


                $created  = $wh->create_rack(["'$warehouse'", "'$zone'", "'$row'", "'$column'", "'$level'", "'$position'"]);

                //echo $name .$address;
                if($created){
                  echo "sxxxx";
                }else{
                  echo "errrr";
                }

            }
        ?>
      </div>
        
      </div>
    </div>


    <div class="modal fade text-left" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">

            <script type="text/javascript">  
              var rack_names = <?php echo json_encode($rack_names);?>;

              generate_form(
                  ['rack', 'product', 'quantity', 'unit', 'file'],
                  ['select', 'text', 'text', 'select', 'file'],
                  [
                    rack_names,
                    ['KG', 'Bag', 'Pallet']
                  ], 
                  [
                    ['r1', 'r2', 'r3'],
                    ['kg1', 'bag1', 'pal']
                  ],   
                  ['Rack', 'Product', 'Quantity', 'Unit', 'Picture']
              );
                   
            </script>

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Add" name="warehouse_added">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
        <?php

            if(isset($_POST['warehouse_added'])){

                $name = $_POST['name'];
                $address = $_POST['address'];

                echo $name .$address;

            }
        ?>
      </div>
        
      </div>
    </div>



    <div class="modal fade text-left" id="addstaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Add Warehouse Staff</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">

            <script type="text/javascript">
              generate_form(
                ['role', 'name', 'phone', 'email', 'password'],
                ['select', 'text', 'text', 'text', 'password'],
                [
                  ['Warehouse Supervisor']
                ],
                [
                  ['Warehouse Supervisor']
                ],
                ['Role', 'Name', 'Phone', 'Email','Password']
                );      
            </script>

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Add" name="staff_added">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>


        <?php

            //if(isset($_POST['warehouse_added'])){

              if(isset($_POST['staff_added'])){

                $auth = new Admin('users', 'phone', 'crm');

                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $role = $_POST['role'];
                $password = $_POST['password']; 
                $status =0;

                $values = ["'$name'", "'$role'", "'$phone'", "'$email'", "'$password'", "'$status'"];
                $columns = ['name', 'role', 'phone', 'email', 'password', 'status'];




                $reg = $auth->register($columns, $values);

                if($reg){
                  $auth->redirect('warehouse_manager.php');
                }else{
                  echo"Sorry";
                }

              }

            
        ?>

        

      </div>
        
      </div>
    </div>


    <div class="modal fade text-left" id="addStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">New Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <!-- Put our form data here -->
          <form class="form form-horizontal form-bordered" method="post">
          <div class="form-body">

            <script type="text/javascript">

              var product_names = <?php echo json_encode($product_names);?>;
              var product_ids = <?php echo json_encode($product_ids);?>;
              var rack_names = <?php echo json_encode($rack_names);?>;
              var rack_ids = <?php echo json_encode($rack_ids);?>;


              generate_form(
                ['product', 'rack', 'quantity', 'status'],
                ['select', 'select', 'number', 'select'],
                [
                  product_names,
                  rack_names,
                  ['Status1', 'Status2', 'Status3']
                ],
                [
                  product_ids,
                  rack_ids,
                  ['stval1', 'stval2', 'stval3']
                ],
                ['Product', 'Rack', 'Quantity', 'Status']
                );      
            </script>

            <div class="col-md-6 col-sm-12">
                <input type="submit" class="btn btn-info btn-outline-secondary" value="Add" name="stock_added">
            </div>
          </div>
        </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>


        <?php

              if(isset($_POST['stock_added'])){

                $product = $_POST['product'];
                $rack = $_POST['rack'];
                $qty = $_POST['quantity'];
                $status = $_POST['status'];

                $added  = $wh->create_stock(["'$product'", "'$rack'", "'$qty'", "'$status'"]);
                if($added){
                  echo"sxxxxxx";
                }else{
                  echo "errrr";
                }

                
              }
            
        ?>

        

      </div>
        
      </div>
    </div>


    <footer class="footer footer-static footer-dark navbar-border navbar-shadow">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block"> </span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/tables/datatables-extensions/datatables-sources.js"></script>
    <!-- END PAGE LEVEL JS-->

    <script type="text/javascript" src="src/my_custom_js.js"></script>


  </body>
</html>