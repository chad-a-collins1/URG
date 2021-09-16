<section role="main" class="content-body">
<header class="page-header">
		<h2>Admin Login</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Admin Login</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
		<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
				   <h2 class="panel-title text-center">Admin Login</h2>
				</header>
				
				<div class="panel-body">
					<form class="form-horizontal form-bordered" method="POST">
					<?php
					foreach($user as $user)
					{
				?>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">User Name</label>
							<div class="col-md-6">
								<input type="text" name="uname" class="form-control" value="<?php echo $user['username'];?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Email</label>
							<div class="col-md-6">
								<input type="email" name="email" class="form-control" value="<?php echo $user['email'];?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Password</label>
							<div class="col-md-6">
								<input type="password" name="password_md5" class="form-control" value="<?php echo $user['password_md5'];?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="inputDefault"></label>
							<div class="col-md-6">
							<button type="submit" name="submit" id="update" class="btn btn-primary theme_btn">Update</button>
							</div>
						</div>
						<?php
					}
					?>
					</form>
				</div>
			</section>
		</div>
	</div>
	