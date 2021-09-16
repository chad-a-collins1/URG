<style>.fade.in{
	opacity:1 !important;
	background:no-repeat;
}
.modal-header
{
display: block!important;
}

.modal-header .close
{
float: right;
}
a{
	color: inherit;
	text-decoration: none;
}
a:hover {
	color: inherit;
	text-decoration: none;
}
</style>
<div class="container">
	<div class="row" style="margin-top:30px;">
		<div class="col-md-3" style="color:green;">
			<h1><a href="<?php echo base_url()."User/view" ?>">URG</a></h1>
			<p>BY RECYCLERS | FOR RECYCLERS</p>
		</div>
		<div class="col-md-9 text-center" style="background-color: #0e7554; color: #fff; padding: 10px 30px; font-size: 18px; margin-top:20px; margin-bottom: 30px;">
			<div class="col-md-12">
				<p>All facilities using a preparer must complete the authorization page before any certifications can be completed</p>
			</div>
		</div>
	</div>
	<?php //echo $_SESSION['user_id']; ?>
	<div class="form-group row justify-content-center">
		<div class="col-md-6 text-center">
			<a href="<?php echo base_url().'User/add_facility'; ?>" class="btn btn-primary theme_btn">Add a New Facility</a>
		</div>
	</div>
	

		<div class="row">
			<div class="col-md-12">
				<table id="facility" class="table table-striped table-bordered table-responsive-md"  style="width:100%">
					<thead>
						<tr>
							<th>Next Step</th>
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
						foreach($viewfacility as $row)
						{
					?>
							<tr>
								<!--<td><label>View copy</label>&nbsp;&nbsp;&nbsp;<a class="btn btn-primary"id="go">Go</a></td>-->
							   <!-- <td><button class="btn btn-primary authorizedfile" data-file="<?php echo $row->authorizationform?>" id="btngo">View </button></td>-->
								 <td>
									<button type="button" id="btns" class="btn btn-primary theme_btn authorizedfile"  data-file="<?php echo $row->authorizationform?>">View</button>
									<a href="<?php echo base_url().'User/add_facility?id='.$row->facilityid; ?>" class="btn btn-primary theme_btn go_btn">Go</a>
								</td>
								
								
								<td><b><?php echo $row->facilityname; ?></b></td>
								<td><?php echo $row->permitnumber; ?></td>
								<td><label><?php echo $row->authorization; ?></label></td>
								<td><?php echo $row->submition_date; ?></td>
								<td><?php echo $row->expiration_date; ?></td>
								<td><label><?php echo $row->status; ?></label></td>
							</tr>
					<?php
							if($row->status == "Approved") {
								$CI =& get_instance();
								$CI->load->model('Main_model');
								$result_data = $CI->Main_model->get_data('userfacilities',array('facility_id'=>$row->facilityid));
								$i=0;
								foreach($result_data as $result_row) {
									if($i == 0 || ($result_data[0]['status'] == "Submitted" || $result_data[0]['status'] == "Approved")){
								?>
										<tr>
											<td>
												<?php if($result_row['tier_description'] != "Authorization"){ ?>
													<a href="<?php echo base_url(); ?>User/tierform?id=<?php echo $result_row['id']; ?>" class="btn btn-primary theme_btn go_btn">View</a>
												<?php }else{ ?>
												<button type="button" id="btns" class="btn btn-primary theme_btn authorizedfile"  data-file="<?php echo $row->authorizationform?>">View</button>
												<?php } ?>
												<a href="<?php echo base_url(); ?>User/tierform?id=<?php echo $result_row['id']; ?>" class="btn btn-primary theme_btn go_btn">Go</a>
											</td>
											<td><?php echo $row->facilityname; ?></td>
											<td><?php echo $row->permitnumber; ?></td>
											<td><label><?php echo $result_row['tier_description']; ?></label></td>
											<td><?php echo $result_row['submition_date']; ?></td>
											<td><?php echo $result_row['expiration_date']; ?></td>
											<td><label><?php echo $result_row['status']; ?></label></td>
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
				
			</div>
		</div>

	
  <!-- Trigger the modal with a button -->
  <!--<button type="button" id="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 145px">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Authorization</h4>
        </div>
        <div class="modal-body">
          <iframe id="myFrame" style="display:none" width="770" src=""  height="300"></iframe>
		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </div>
      
    </div>
  </div>
  
    <!-- Modal -->
  <div class="modal fade" id="payment_msg" role="dialog">
    <div class="modal-dialog modal-md" style="margin-top: 145px">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<h2 id="msg_lbl"></h2>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </div>
      
    </div>
  </div>
  
</div>
	<script src="<?php echo resources_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
	<script>
     /* $(".authorizedfile").click(function(){
			
			// alert("hello"); 	
		// var a = document.getElementById("myFrame");
        // a.style.display="block";
	
		var file=$(this).data("file");
		//alert(file);
		var url = '<?php echo base_url()."upload/"; ?>'+file; 
        // a.src = '"'+url+'"upload/2020-01-27_06:55:37.pdf"';
		// alert('"'+siteurl+'upload/2020-01-27_06:55:37.pdf"');
		$('#mFrame').attr('src',url);
		$('#myFrame').show();
		
		});*/
		
	jQuery(document).ready(function(){

		jQuery("body").on("click",".authorizedfile",function(){

			jQuery("#myModal").modal("show");

			var file=jQuery(this).data("file");
			//alert(file);
			var url = '<?php echo resources_url()."upload/"; ?>'+file;

			jQuery('#myFrame').attr('src',url);
			jQuery('#myFrame').show();

		});
	
		<?php 
		if(!empty($this->session->flashdata('payment_msg'))){
		$msg = $this->session->flashdata('payment_msg');
			if($msg == "success") {
		?>
				jQuery("#msg_lbl").text("Your payment has been success.");
				jQuery("#payment_msg").modal("show");
				
		<?php
			}else {
		?>
				jQuery("#msg_lbl").text("Your payment has been fail.");
				jQuery("#payment_msg").modal("show");
		<?php
			}
		}
		?>

	  
	 });
/*$(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );*/
	
	</script>
	
	

  

