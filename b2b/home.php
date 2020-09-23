<?php
  session_start();
  
  include('../modules/Compl_Classes.php');
  $us = new Admin('customers', 'email', 'crm');

  

  if(!isset($_SESSION['email'])){
    $us->logout('index.php');
  }else{
    $email = $_SESSION['email'];

    $user_details = $us->get('customers', ['name'], ['email'], [$email], 'single');
    $name = $user_details[0]['name'];

  }

  if(isset($_GET['logout'])){
    $us->logout('index.php');
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
    <title>Products [Category] </title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    BEGIN VENDOR CSS -->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
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
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark bg-primary navbar-shadow navbar-brand-center">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
               
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a></li>
              
                <ul class="mega-dropdown-menu dropdown-menu row">
                  <li class="col-md-2">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="fa fa-newspaper-o"></i> News</h6>
                    <div id="mega-menu-carousel-example">
                      <div><img class="rounded img-fluid mb-1" src="../app-assets/images/slider/slider-2.png" alt="First slide"><a class="news-title mb-0" href="#">Poster Frame PSD</a>
                        <p class="news-content"><span class="font-small-2">January 26, 2018</span></p>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-random"></i> Drill down menu</h6>
                    <ul class="drilldown-menu">
                      <li class="menu-list">
                        <ul>
                          <li><a class="dropdown-item" href="layout-2-columns.html"><i class="ft-file"></i> Page layouts & Templates</a></li>
                          <li><a href="#"><i class="ft-align-left"></i> Multi level menu</a>
                            <ul>
                              <li><a class="dropdown-item" href="#"><i class="fa fa-file-o"></i>  Second level</a></li>
                              <li><a href="#"><i class="fa fa-star-o"></i> Second level menu</a>
                                <ul>
                                  <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i>  Third level</a></li>
                                  <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> Third level</a></li>
                                  <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> Third level</a></li>
                                  <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> Third level</a></li>
                                </ul>
                              </li>
                              <li><a class="dropdown-item" href="#"><i class="fa fa-film"></i> Second level, third link</a></li>
                              <li><a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Second level, fourth link</a></li>
                            </ul>
                          </li>
                          <li><a class="dropdown-item" href="color-palette-primary.html"><i class="ft-camera"></i> Color palette system</a></li>
                          <li><a class="dropdown-item" href="../starter-kit/ltr/vertical-menu-template/layout-2-columns.html"><i class="ft-edit"></i> Page starter kit</a></li>
                          <li><a class="dropdown-item" href="changelog.html"><i class="ft-minimize-2"></i> Change log</a></li>
                          <li><a class="dropdown-item" href="https://pixinvent.ticksy.com/"><i class="fa fa-life-ring"></i> Customer support center</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-list"></i> Accordion</h6>
                    <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                      <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                        <div class="card-header p-0 pb-2 border-0" id="headingOne" role="tab"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionOne" aria-expanded="true" aria-controls="accordionOne">Accordion Item #1</a></div>
                        <div class="card-collapse collapse show" id="accordionOne" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                          <div class="card-content">
                            <p class="accordion-text text-small-3">Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie.</p>
                          </div>
                        </div>
                        <div class="card-header p-0 pb-2 border-0" id="headingTwo" role="tab"><a class="collapsed" data-toggle="collapse" data-parent="#accordionWrap" href="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">Accordion Item #2</a></div>
                        <div class="card-collapse collapse" id="accordionTwo" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                          <div class="card-content">
                            <p class="accordion-text">Sugar plum bear claw oat cake chocolate jelly tiramisu dessert pie. Tiramisu macaroon muffin jelly marshmallow cake. Pastry oat cake chupa chups.</p>
                          </div>
                        </div>
                        <div class="card-header p-0 pb-2 border-0" id="headingThree" role="tab"><a class="collapsed" data-toggle="collapse" data-parent="#accordionWrap" href="#accordionThree" aria-expanded="false" aria-controls="accordionThree">Accordion Item #3</a></div>
                        <div class="card-collapse collapse" id="accordionThree" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                          <div class="card-content">
                            <p class="accordion-text">Candy cupcake sugar plum oat cake wafer marzipan jujubes lollipop macaroon. Cake dragée jujubes donut chocolate bar chocolate cake cupcake chocolate topping.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  
                </ul>
              </li>
              
            </ul>
            <ul class="nav navbar-nav float-right"> 
                
                <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-shopping-cart"></i><span class="badge badge-pill badge-default badge-info badge-default badge-up">5              </span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <h6 class="dropdown-header m-0"><span class="grey darken-2">Cart</span></h6><span class="notification-tag badge badge-default badge-warning float-right m-0">4 New</span>
                    </li>
                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                        
                        <div class="media">
                            <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="../app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                            <div class="media-body">
                            <h6 class="media-heading">Bret Lezama</h6>
                            <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                                <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Tuesday</time></small>
                            </div>
                        </div></a><a href="javascript:void(0)">
                        
                        
                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
                    </ul>
                </li>

              
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
                        <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="../app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">Bret Lezama</h6>
                          <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Tuesday</time></small>
                        </div>
                      </div></a><a href="javascript:void(0)">
                      
                      
                  <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
                </ul>
              </li>



              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><i></i></span><span class="user-name"><?php echo $name; ?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="ft-user"></i> Edit Profile</a>
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

            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.templates.main">Categories</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">Category1</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="../vertical-overlay-menu-template" data-i18n="nav.templates.vert.overlay_menu">Sub-category</a>
                            </li>
                            <li><a class="menu-item" href="../vertical-multi-level-menu-template" data-i18n="nav.templates.vert.multi_level_menu">Sub-category</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Category2</a>
                        <ul class="menu-content">
                        <li><a class="menu-item" href="../horizontal-menu-template" data-i18n="nav.templates.horz.classic">Subcategory</a>
                        </li>
                        <li><a class="menu-item" href="../horizontal-top-icon-menu-template" data-i18n="nav.templates.horz.top_icon">Subcategory</a>
                        </li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li class=" nav-item"><a href="#"><span class="menu-title" data-i18n="nav.templates.main">Orders</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="orders.php" data-i18n="nav.templates.vert.main">View orders</a>
                        
                    </li>
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Update</a>
                        
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
            <h3 class="content-header-title">Products</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                
                


              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12">
            <fieldset class="form-group relative has-icon-left col-md-5 col-12 float-right p-0">
              <input class="form-control" id="searchButton" type="text" placeholder="Search..."/>
              <div class="form-control-position"><i class="fa fa-search"></i></div>
            </fieldset>
          </div>
        </div>
<div class="content-body"><!-- Basic example section start -->

<section id="decks">
	
    <div class="row">
		<div class="col-12">
			<div class="card-deck-wrapper">
				<div class="card-deck">
			    <div class="card">
					<div class="card-content">
						<img class="card-img-top img-fluid" src="../app-assets/images/carousel/05.jpg" alt="Card image cap"/>
              


              <div class="card-body">
                <h4 class="card-title" id="productPrice">Product name [$19.8]</h4>
                <p>
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Quantity" type="text" min="1" id="productQty" >
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Total" type="text" min="1" id="productTotal" readonly>
                </p>

                <p class="card-text">
                  This is is the description
                </p>

                <a href="products.html?id=1">
                  <button type="submit" class="btn btn-info">
                    <i class="fa fa-shopping-cart"></i> Order
                  </button>
                </a>
              </div>
              



			</div>
			</div>
			<div class="card">
				<div class="card-content">
					<img class="card-img-top img-fluid" src="../app-assets/images/carousel/09.jpg" alt="Card image cap"/>
              
                <div class="card-body">
                <h4 class="card-title" id="productPrice">Product name [$19.8]</h4>
                <p>
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Quantity" type="text" min="1" id="productQty" >
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Total" type="text" min="1" id="productTotal" readonly>
                </p>
                 
                <p class="card-text">
                  This is is the description
                  
                </p>

                 
                
                <a href="products.html?id=1">
                  <button type="submit" class="btn btn-info">
                    <i class="fa fa-shopping-cart"></i> Order
                  </button>
                </a>
              </div>
              

						</div>
					</div>
					<div class="card">
						<div class="card-content">
							<img class="card-img-top img-fluid" src="../app-assets/images/carousel/02.jpg" alt="Card image cap"/>
							<div class="card-body">
                <h4 class="card-title" id="productPrice">Product name [$19.8]</h4>
                <p>
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Quantity" type="text" min="1" id="productQty" >
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Total" type="text" min="1" id="productTotal" readonly>
                </p>
                 
                <p class="card-text">
                  This is is the description
                  
                </p>

                 
                
                <a href="products.html?id=1">
                  <button type="submit" class="btn btn-info">
                    <i class="fa fa-shopping-cart"></i> Order
                  </button>
                </a>
              </div>

              

						</div>
					</div>
					<div class="card">
						<div class="card-content">
							<img class="card-img-top img-fluid" src="../app-assets/images/carousel/03.jpg" alt="Card image cap"/>
              

              <div class="card-body">
                <h4 class="card-title" id="productPrice">Product name [$19.8]</h4>
                <p>
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Quantity" type="text" min="1" id="productQty" >
                    <input class="col-sm-12 col-md-7 float-right" placeholder="Total" type="text" min="1" id="productTotal" readonly>
                </p>
                 
                <p class="card-text">
                  This is is the description
                  
                </p>

                 
                
                <a href="products.html?id=1">
                  <button type="submit" class="btn btn-info">
                    <i class="fa fa-shopping-cart"></i> Order
                  </button>
                </a>
              </div>
              




						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Decks section end -->

<!-- Columns section start -->

<!-- Columns section end -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <script>


      (function() {
      
      
          var typingTimer;                
          var doneTypingInterval = 500;
      
         
          var qty = document.getElementById('productQty');
          var ttl = document.getElementById('productTotal');
          var searchBtn = document.getElementById('searchButton');
          
          
          qty.onkeyup = function () {
              clearTimeout(typingTimer);
              typingTimer = setTimeout(calcTotal, doneTypingInterval);
          }

          searchBtn.onkeyup = function () {
              clearTimeout(typingTimer);
              typingTimer = setTimeout(search, doneTypingInterval);
          }
      
          function calcTotal () {
              if(Number.isInteger(parseInt(qty.value)) ){
                  ttl.value = qty.value * 19.8;
              }else{
                  ttl.value =0;
              }
          }


          function search () {

              //Seach should be implemented here
              
              if(searchBtn.value){
                alert(searchBtn.value);
              }
          }
      
      
      
      }());
      
      </script>


    <footer class="footer footer-static footer-dark navbar-border navbar-shadow">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; <?php echo date('Y'); ?><a class="text-bold-800 grey darken-2" href="#" target="_blank"> Popa Daniel </a>, All rights reserved. </span> </p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>