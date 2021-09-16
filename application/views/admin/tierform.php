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
		<div class="col-md-12">
			<form method="post" enctype="multipart/form-data">
				<table id="facility" class="table table-striped table-bordered"  style="width:100%">
					<thead>
						<tr style="color: green;">
						<!--<th>Category</th>-->
							<th><h4>Question</h4></th>
							<th><h4>Answer</h4></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=1;$j=1;$k=1;
						$temp='';
						// print_r($viewquestion);
						foreach($viewquestion as $row) 
						{
						//print_r($viewquestion);
						   $categoryname = $row->category;
							//print_r($categoryname);
							if($temp != $categoryname)
							{?>
								<tr><td colspan="2" class="text-center"><h5 style="font-weight: bold;"><?php echo $row->category; ?></h5></td></tr>
								<?php
								$temp = $row->category;
								
							}
					     ?>
					
				          <tr>
							<!--<td><?php echo $row->category; ?></td>-->
								<td>
									<?php 
										echo $row->question." "; 
										echo " <a class='text-danger instructionlink'  href='javascript:void(0);' data-instructionlink = '".$row->instructionlink."' >".$row->instructiontext."</a>";
									?>
								</td>
							
							<?php
								$req = "";
								
								if($row->required == 1){
									$req = "required";
								}else {
									$req = "";
								}
								// echo $req;
								if($row->qtype == "Text" ) {
							?>
									<td><input type="text" class="form-control" name="answer_<?php echo $i; ?>" <?php echo $req; ?>>
									<input type="hidden" name="qid_<?php echo $i;?>" value="<?php  echo $row->questionid ?>"></td>
							<?php
									$i++;
								}
								
								if($row->qtype == "Upload") {
							?>
									<td><input type="file" name="file_<?php echo $j; ?>" <?php echo $req; ?>> 
									<input type="hidden" name="qfid_<?php echo $j;?>" value="<?php  echo $row->questionid ?>"></td>
							<?php
									$j++;
								}
								
								if($row->qtype == "DropDown") {
									$dropdowndata = explode(",",$row->dropdown_category);
									// print_r($dropdowndata);
							?>
									<td>
										<div class="form-group">
										<select class="form-control" name="drpdwn_<?php echo $k;?>" <?php echo $req; ?>>
										<?php 
											foreach($dropdowndata as $dropdownoption) {
												echo "<option value='".$dropdownoption."'>".$dropdownoption."</option>";
											}
										?>
										</select>
										<input type="hidden" name="qdid_<?php echo $k;?>" value="<?php  echo $row->questionid ?>">
									</td>
							<?php
									$k++;
								}
							?>

							</tr>					
							<?php 
							}
						
							  $k--;
							  $i--;
							  $j--;
							?>
							<tr>
								<td colspan="3"><center><button type="submit" name="add" class="btn btn-primary theme_btn">Submit</button></center></td>
							</tr>
					</tbody>

					</table>
				<input type="hidden" name="totaldp" value="<?php echo $k;?>">
				<input type="hidden" name="totaltext" value="<?php echo $i;?>">
				<input type="hidden" name="totalfile" value="<?php echo $j;?>">
				</form>
			</div>
		</div>
	</div>
	
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg" style="margin-top: 145px">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Example</h4>
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
  
<script src="<?php echo resources_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script>
	$(document).ready(function() {
		$('.instructionlink').click(function() {
			var filename = $(this).data('instructionlink');
			if(filename.length >= 5) {
				$("#myModal").modal("show");
				var url = '<?php echo resources_url()."upload/questioninstruction/"; ?>'+filename;
				jQuery('#myFrame').attr('src',url);
				jQuery('#myFrame').show();
			}else {
				alert('File not found');
			}
			
		});
	});
</script>