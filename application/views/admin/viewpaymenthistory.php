<section role="main" class="content-body">
	<header class="page-header">
		<h2>Payment History</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>History</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
	
	<div class="row">
		<div class="col-lg-12">
			<table id="state_table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>User Name</th>
						<th>Facility</th>
						<th>Tier</th>
						<th>Transaction ID</th>
						<th>Payment Status</th>
						<th>Payment Response</th>
						<th>Amount</th>
						<th>Payment Date</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					// print_r($historydata);
					foreach($historydata as $key => $history) {
				?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $history['username']; ?></td>
						<td><?php echo $history['facilityname']; ?></td>
						<td><?php echo $history['description']; ?></td>
						<td><?php echo $history['transaction_id']; ?></td>
						<td><?php echo $history['payment_status']; ?></td>
						<td><?php echo $history['payment_response']; ?></td>
						<td><?php echo $history['amount']; ?></td>
						<td><?php echo $history['create_at']; ?></td>
					</tr>
				<?php
					}
				?>
					
				</tbody>
			</table>
		</div>
	</div>
	
</section>
