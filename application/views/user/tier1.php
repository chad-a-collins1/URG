<div class="container">
	<div class="row" style="margin-top:30px;">
		<div class="col-md-3" style="color:green;">
			<h1>URG</h1>
			<p>BY RECYCLERS | FOR RECYCLERS</p>
		</div>
		<div class="col-md-9 text-center" style="background-color: #0e7554; color: #fff; padding: 10px 30px; font-size: 18px; margin-top:20px; margin-bottom: 30px;">
			<div class="col-md-12">
				<p>All facilities using a preparer must complete the authorization page before any certifications can be completed</p>
			</div>
		</div>
	</div>
	
	<div class="form-group row justify-content-center">
		<div class="col-md-6 text-center">
			<a href="<?php echo base_url().'User/add_facility'; ?>" class="btn btn-primary theme_btn">Add a New Facility</a>
		</div>
	</div>
	
	
	
  <div class="row">
	 <div class="col-lg-12">
		<table id="state_table" class="table table-striped table-bordered" style="width:100%">
		     <thead>
			     <tr>
					<th>Question Category</th>
					<th>Question</th>
					<th>Question Type</th>
				</tr>
			 </thead>
			 <tbody>
			    <?php 
				  foreach($viewquestiontype as $row)
				  {
			     ?>
					<tr>
					<td><?php echo $row->categorytext; ?></td>
					<td><?php echo $row->question; ?></td>
					<?php
					if($row->qtype == "Text" )
					{
						?>
						<td><input type="text"></td>
						<?php
					}
					else if($row->qtype == "Upload")
					{
						?>
						<td><input type="file"></td>
						<?php
					}
					else
					{
						?>
						<td><select name="drpdwn">
						<option>Yes </option>
	                     <option>No</option>
	
						</select>
						</td>
						<?php
					}
					?>
					<!--<td><?php echo $row->qtype; ?></td>-->
                    </tr>					
			    <?php 
					  
				  }
				?>
			  </tbody>
			  
			</table>
			 
		</div>
	</div>
	
</div>


