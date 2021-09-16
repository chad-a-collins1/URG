
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
				<div class="col-md-12  text-center" style="color: #434544;">
					<h1>User Login</h1>
				</div>
			</div>
			
			<div class="row" style="margin-top: 30px;">
				<div class="col-md-12 text-center">
				<form method="POST">
				<?php
					foreach($user as $user)
					{
				?>
				    <div class="col-md-12">
					<div class="form-group row justify-content-center">
						<label class="col-sm-2 col-form-label">User Name</label>
						<div class="col-sm-4">
							<input type="text" name="uname" class="form-control" value="<?php echo $user['username'];?>">
						</div>
					</div>
					</div>
					
					<div class="col-md-12">
					<div class="form-group row justify-content-center">
						<label class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-4">
							<input type="email" name="email" class="form-control" value="<?php echo $user['email'];?>">
						</div>
					</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group row justify-content-center">
							<label class="col-sm-2 col-form-label">Service Type</label>
							<div class="col-sm-4">
							<select name="servicetype" class="form-control">
							<?php 	
							foreach($service as $row)
									{ 
									if($user['servicetype'] == $row['serviceid'])
										{
											$sel = "selected";
										}
										else
										{
											$sel='';
										}
									
										echo '<option value="'. $row['serviceid'].'" '.$sel.'>'. $row['servicetype'].'</option>';
									}
									?>
									</select>
						</div>
					</div>
					</div>
				
					<div class="col-md-12">
					<div class="form-group row justify-content-center">
						<label class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-4">
							<input type="password" name="password_md5" class="form-control" value="<?php echo $user['password_md5'];?>">
						</div>
					</div>
					</div>
					
					<div class="col-md-12">
					<div class="form-group row justify-content-center">
						<div class="col-sm-6">
							<button type="submit" name="submit" id="update" class="btn btn-primary theme_btn">Update</button>
						</div>
					</div>
					</div>
					<?php
					}
					?>
				</form>
				</div>
			</div>
		</div>
	
	<!-- Imported JS on this page -->
	<script src="<?php echo resources_url(); ?>assets/js/jquery-1.11.3.min.js"></script>		
	<script src="<?php echo resources_url(); ?>assets/js/bootstrap.js"></script>

	</body>
</html>