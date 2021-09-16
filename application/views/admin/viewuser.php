<?php 
/*if(isset($_GET['id']))
{
	echo $userid=$_GET['id'];
}
else
{
	$userid=$viewuser[0]['userid'];
}
	?>*/
	?>
<section role="main" class="content-body">
<header class="page-header">
		<h2>View User</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>View User</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
	
  <div class="row">
	 <div class="col-lg-12">
	 <form>
		<table id="state_table" class="table table-striped table-bordered">
		     <thead>
			     <tr>
				  
				    <th></th>
					<th>Facility</th>
					<th>Permit Number</th>
					<th>Description</th>
					<th>Submition Date</th>
					<th>Expiration Date</th>
					<th>Status</th>
				</tr>
			 </thead>
			 <tbody>
			    <?php 
				  foreach($viewuser as $row)
				  {
		
			     ?>
					<tr>
					        <td><a href="<?php echo base_url().'Admin/add_facility?id='.$row['facilityid']; ?>" class="btn btn-primary theme_btn">View</a></td>
					        <td><?php echo $row['facilityname'];?></td>
							<td><?php echo $row['permitnumber'];?></td>
							<td><label>Authorization</label></td>
							<td><?php echo $row['submition_date'];?></td>
							<td><?php echo $row['expiration_date'];?></td>
							<td>
							<select name="status" class="status" id="status" data-facilityid="<?php echo $row['facilityid']; ?>">
								<option <?php if($row['status'] == "In Progress"){echo 'selected'; } ?> value="In Progress">In Progress</option>
								<option <?php if($row['status'] == "Submitted"){echo 'selected'; } ?> value="Submitted">Submitted</option>
								<option <?php if($row['status'] == "Approved"){echo 'selected'; } ?> value="Approved">Approved</option>
							</select>
				            </td>
						</tr>
				  <?php 
					 if($row['status'] == "Approved") {
								$CI =& get_instance();
								$CI->load->model('Main_model');
								$result_data = $CI->Main_model->get_data('userfacilities',array('facility_id'=>$row['facilityid']));
								$i=0;
								foreach($result_data as $result_row) {
									if($i == 0 || ($result_data[0]['status'] == "Submitted" || $result_data[0]['status'] == "Approved")){
								?>
										<tr>
											 <td><a href="<?php echo base_url(); ?>Admin/tierform?id=<?php echo $result_row['id']; ?>" class="btn btn-primary theme_btn">View</a></td>
											<td><?php echo $row['facilityname']; ?></td>
											<td><?php echo $row['permitnumber']; ?></td>
											<td><label><?php echo $result_row['tier_description']; ?></label></td>
											<td><?php echo $result_row['submition_date']; ?></td>
											<td><?php echo $result_row['expiration_date']; ?></td>
											<!--<td><?php echo $result_row['status']; ?></td>-->
											<td>
						                    <select name="status" class="status" id="status" data-facilityid="<?php echo $result_row['id']; ?>">
												<option <?php if($result_row['status'] == "In Progress"){echo 'selected'; } ?> value="In Progress">In Progress</option>
												<option <?php if($result_row['status'] == "Submitted"){echo 'selected'; } ?> value="Submitted">Submitted</option>
												<option <?php if($result_row['status'] == "Approved"){echo 'selected'; } ?> value="Approved">Approved</option>
                                           </select>
                                           </td>
                                       </tr>
							<?php
								}
								$i++;
							}
						}
			  }
				?>
			  </tbody>
			  
			</table>
			 </form>
		</div>
	</div>
	
</section>



<script>

$(document).ready(function() {
  
 $('.status').on('change',(function(){
	  
	 //  alert('view');
	    var facilityid = $(this).data('facilityid');
        var status = $(this).val(); 
		alert(facilityid);
        $.ajax({
                type:'POST',
	            url:"<?php echo base_url();?>Admin/updatestatus?facilityid="+facilityid,
			    dataType: 'json',
                data:{
					 "facilityid":facilityid,
					 "status":status
				 },
			
				 success: function(response) 
				 {
					//alert(update successfully);
					
				 }
			});
		
	   }));		
  });		 

</script>