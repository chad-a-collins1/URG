<section role="main" class="content-body">
<header class="page-header">
		<h2>Add A New Facility</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add A New Facility</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
		<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
				   <h2 class="panel-title text-center">Add A New Facility</h2>
				</header>
				
				<div class="panel-body">
					<form class="form-horizontal form-bordered" method="POST">
					<?php
					foreach($facility as $user)
					{
				?>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Facility Name</label>
							<div class="col-md-6">
								<input type="text" name="facility_name" class="form-control" value="<?php echo $user['facilityname'];?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Facility state</label>
							<div class="col-md-6">
							<select>
							<?php echo '<option value="'.$user['facilitystate'].'">'.$user['facilitystate'].'</option>'?>
							</select>
								<!--<select name="facility_state" class="form-control">
						        <option selected value="1">1</option>
						        <option value="2">2</option>
						        <option value="3">3</option>
					           </select>-->
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Facility Permit Number</label>
							<div class="col-md-6">
								<input type="text" name="facility_permit_number" class="form-control" value="<?php echo $user['permitnumber'];?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Upload authorization page</label>
							<div class="col-md-6">
								<input type="file" name="file_page" class="form-control">
				             </div>
							</div>
						</div>
					<!--	<div class="form-group">
							<label class="col-md-2 control-label" for="inputDefault"></label>
							<div class="col-md-6">
							<button type="submit" name="submit" id="update" class="btn btn-primary theme_btn">Update</button>
							</div>
						</div>-->
					<?php
					}
					?>
					</form>
				</div>
			</section>
		</div>
	</div>
	