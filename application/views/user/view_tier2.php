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
	
	
	<div class="row">
			<div class="col-md-12">
			<form method="post" enctype="multipart/form-data">
				<table id="facility" class="table table-striped table-bordered"  style="width:100%">
				  <thead>
			     <tr>
				
					<th>Question</th>
					<th>Question Type</th>
				</tr>
			 </thead>
			 <tbody>
			    <?php 
				$i=1;$j=1;$k=1;
				  foreach($viewquestion as $row)
				  {
				 ?>
				 <tr>
					<td><?php echo $row->question; ?></td>
					<?php
					if($row->qtype == "Text" )
					{
						?>
						<td><input type="text" name="answer_<?php echo $i; ?>">
						<input type="hidden" name="qid_<?php echo $i;?>" value="<?php  echo $row->questionid ?>"></td>
						
						<?php
						  $i++;
						 
					}
					if($row->qtype == "Upload")
					{
						?>
						<td><input type="file" name="file_<?php echo $j; ?>"> 
						<input type="hidden" name="qfid_<?php echo $j;?>" value="<?php  echo $row->questionid ?>"></td>
						<?php
						  $j++;
						
					}
					if($row->qtype == "DropDown")
					{
						?>
						<td><select name="drpdwn_<?php echo $k;?>">
						<option value="yes">Yes </option>
	                     <option value="no">No</option>
	
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
				 <input type="hidden" name="totaldp" value="<?php echo $k;?>">
				 <input type="hidden" name="totaltext" value="<?php echo $i;?>">
				 <input type="hidden" name="totalfile" value="<?php echo $j;?>">
				 
				<tr>
				<td colspan="3"><center><button type="submit" name="add" class="btn btn-primary theme_btn">Submit</button></center></td>
				</tr>
				
			  </tbody>
			 
			</table>
					
					
				
				</form>
			</div>
	</div>
	<script>
	/*$(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );*/
	</script>