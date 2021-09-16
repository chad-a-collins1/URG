<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--<link rel="icon" href="assets/images/favicon.ico">-->
		
		<title>Index</title>
		
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/css/font-icons/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/style.css">
		
		
   </head>
   
  
   <body>
   <header class="header">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
     <a class="navbar-brand" href="#">
       <!--  <img src="http://placehold.it/150x50?text=Logo" alt="">-->
        </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url();?>User/view">Dashboard
                <span class="sr-only">(current)</span>
              </a>
        </li>
		<li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url();?>User/Profile">My Profile
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>User/logout">Logout</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
</header>
<style>
.collapse.in{
	display:block !important;
	}
</style>
