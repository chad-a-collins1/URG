<section role="main" class="content-body">
<header class="page-header">
		<h2>User</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>User</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
	
  <div class="row">
	 <div class="col-lg-12">
		<table id="state_table" class="table table-striped table-bordered">
		     <thead>
			     <tr>
					<th>User name</th>
					<th>Email</th>
					<th>role</th>
					<th>createdate</th>
					<th>Action</th>
				</tr>
			 </thead>
			 <tbody>
			    <?php 
				  foreach($user as $row)
				  {
			     ?>
					<tr>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['role']; ?></td>
					<td><?php echo $row['createdate']; ?></td>
					<!--<td><button class="btn btn-primary">Dashoard</button></td>-->
					<td><a href="<?php echo base_url().'Admin/viewuser?userid='.$row['userid']; ?>" class="btn btn-primary">Dashoard</a></td>
					</tr>					
			    <?php 
					  
				  }
				?>
			  </tbody>
			  
			</table>
			 
		</div>
	</div>
	
</section>

<script>

$(document).ready(function() {
    $('#state_table').DataTable();
} );
</script>