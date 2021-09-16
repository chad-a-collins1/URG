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
			
			<div class="row">
				<div class="col-md-12 text-center" style="color:#434544;">
					<h1>Registration</h1>
				</div>
			</div>
			
			<div class="row" style="margin-top: 30px;">
				<div class="col-md-12">
				<form method="POST">
					<div class="col-md-12">
						<div class="form-group row justify-content-center">
							<label class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-4">
								<input type="text" name="user_name" class="form-control">
							</div>
						</div>
					</div>
					
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
							<label class="col-sm-2 col-form-label">Service Type</label>
							<div class="col-sm-4">
								<select name="service_type" class="form-control">
									<option selected value="full_service">Full Service</option>
									<option value="self_service">Self Service</option>
									<option value="both">Both</option>
									<option value="other">Other</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group row justify-content-center">
							<label class="col-sm-2 col-form-label">Are You An Approved Auditor ?</label>
							<div class="col-sm-4">
								<select name="approved" class="form-control">
									<option selected value="yes">Yes</option>
									<option value="no">No</option>
								</select>
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
							<div class="col-sm-6 justify-content-center">
								<button type="submit" name="register" class="btn btn-primary theme_btn">Register</button>
							</div>
						</div>
					</div>
					
				</form>
				</div>
			</div>
		</div>
	
	<!-- Imported JS on this page -->
	<script src="<?php echo resources_url(); ?>assets/js/jquery-1.11.3.min.js"></script>		
	<script src="<?php echo resources_url(); ?>assets/js/bootstrap.js"></script>

	</body>
</html>