<!DOCTYPE html>
<!--<html lang="en">
	<head>
		<link rel="icon" href="assets/images/favicon.ico">
		<title>Index</title>
		
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
		
   </head>
   
   <body>
 -->  
 

<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Dashboard | URG Admin</title>
		<meta name="keywords" content="URG Admin" />
		<meta name="description" content="URG Admin">
		<meta name="author" content="">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/stylesheets/theme-custom.css">
		
		<!-- JQ Gurid CSS -->
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/jqgrid/css/ui.jqgrid.css">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/jqgrid/css/jquery-ui.min.css">
		
		<!-- Head Libs -->
		<script src="<?php echo resources_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
		<script src="<?php echo resources_url(); ?>assets/vendor/jquery/jquery.js"></script>
		<!-- <link rel="stylesheet" href="<?php echo resources_url(); ?>assets/style.css"> -->
		<style>
			.ui-th-ltr,
			.ui-jqgrid .ui-jqgrid-htable th.ui-th-ltr {
				border-left: 0 none;
				background: #f6f6f6;
				color: #33353f;
			}
			.ui-jqgrid .ui-jqgrid-htable,
			.ui-jqgrid .ui-jqgrid-btable{
				width: 100% !important;
			}
			.ui-state-default, 
			.ui-widget-content .ui-state-default, 
			.ui-widget-header .ui-state-default {
				border: 1px solid #DADADA;
				background: #f6f6f6;
			}
			.ui-widget-content {
				border: 1px solid #DADADA;
			}
			.ui-jqgrid tr.jqgrow, 
			.ui-jqgrid tr.jqgroup {
				height: 38px !important;
				font-size: 16px !important;
			}
			.ui-jqgrid .ui-jqgrid-bdiv {
				background: #fdfdfd !important;
			}
			.ui-state-hover {
				border: 0 !important;
				background: #f5f5f5 !important;
			}
			.ui-state-hover td {
				border-color: #DADADA !important;
				background: #f5f5f5 !important;
			}
			.ui-state-highlight,
			.ui-widget-content .ui-state-highlight, 
			.ui-widget-header .ui-state-highlight {
				border: 1px solid #DADADA !important;
				background: #f5f5f5 !important;
			}
			.ui-jqgrid tr.ui-search-toolbar td > input:focus {
				border-color: #33bbff !important;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(0, 136, 204, 0.3) !important;
			}
			.ui-jqgrid .ui-icon-desc {
				font-size: 16px;
			}
			.ui-jqgrid .ui-icon-asc {
				margin-top: 1px;
				font-size: 16px; 
			}
			.ui-jqgrid .ui-jqgrid-sortable {
				line-height: 30px;
				height: auto;
			}
		</style>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="<?php echo base_url(); ?>Admin/dashbord" class="logo">
						<img src="<?php echo resources_url(); ?>assets/images/logo/urg_logo.png" height="35" alt="JSOFT Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo resources_url(); ?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
								<span class="name">Admin</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<!--<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>-->
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>/Admin/logout"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="<?php echo base_url('Admin/dashbord'); ?>">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Question Categories</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/question_categories'); ?>">
													Question Categories
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Services</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/service'); ?>">
													Service Type
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Tier</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/tire'); ?>">
													Tier Page
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Question</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/questions'); ?>">
													Questions
												</a>
											</li>
											<li>
												<a href="<?php echo base_url('Admin/add_question'); ?>">
													Add Question
												</a>
											</li>
										</ul>
									</li>
									
										<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Question Type</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/question_type'); ?>">
													Question Type 
												</a>
											</li>
										</ul>
									</li>
										<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>View Questions</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/viewquestiontype'); ?>">
													View All Questions
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>User</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/user'); ?>">
												User
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Payment</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="<?php echo base_url('Admin/paymenthistory'); ?>">
												Payment History
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>				
							
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->
