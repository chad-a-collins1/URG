<section role="main" class="content-body">
<header class="page-header">
		<h2>View Question Type</h2>
		
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>View Question Type</span></li>
			</ol>
	
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
	
  <div class="row">
	 <div class="col-lg-12">
		<table id="state_table" class="table table-striped table-bordered">
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
	
</section>

<script>

$(document).ready(function() {
    $('#state_table').DataTable();
} );
</script>