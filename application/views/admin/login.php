<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="icon" href="assets/images/favicon.ico">
		<title>Index</title>

		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/css/font-icons/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?php echo resources_url(); ?>assets/style.css">
	</head>
   
	<body>
	
		<div class="container">
			<div class="row" style="margin-top:30px;">
				<div class="col-md-3" style="color:green;">
					<h1>URG</h1>
					<p>BY RECYCLERS | FOR RECYCLERS</p>
				</div>
			</div>
			
			<div class="row" style="margin-top:30px;">
				<div class="col-md-12 text-center" style="color: #434544;">
					<h1>Admin Login</h1>
				</div>
			</div>
			
			<div class="row" style="margin-top: 30px;">
				<div class="col-md-12 ">
				<form method="POST" action="<?php echo base_url('Admin/login'); ?>">
					<div class="col-md-12">
					<div class="form-group row justify-content-center">
						<label class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-4">
							<input type="email" name="email" class="form-control">
						</div>
					</div>
					</div>
					
					<div class="col-md-12">
					<div class="form-group row justify-content-center">
						<label class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-4">
							<input type="password" name="password" class="form-control">
						</div>
					</div>
					</div>
					
					<div class="col-md-12">
					<div class="form-group row justify-content-center">
						<div class="col-sm-6">
							<button type="submit" name="login" class="btn btn-primary theme_btn">Login</button>
						</div>
					</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	
	<!-- Imported JS on this page -->
	<script src="<?php echo resources_url(); ?>assets/js/jquery-3.4.1.min.js"></script.>		
	<script src="<?php echo resources_url(); ?>assets/js/bootstrap.js"></script>

	</body>
</html>