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



<?php
require_once '/var/www/html/ecomply-urg-certification.com/public_html/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


if (isset($_SERVER['REQUEST_URI'])) {
    $generate = isset($_GET['make_pdf']);
    $nom = isset($_GET['nom']) ? $_GET['nom'] : 'inconnu';
    $url = dirname($_SERVER['REQUEST_URI']);
    if (substr($url, 0, 7)!=='http://') {
        $url = 'http://'.$_SERVER['HTTP_HOST'].$url;
    }
} else {
    $generate = true;
    $nom = 'spipu';
    $url = 'https://www.ecomply-urg-certification.com';
}

 $generate = true;

$nom = substr(preg_replace('/[^a-zA-Z0-9]/isU', '', $nom), 0, 26);
$url.= '/index.php/User/tierformpdf?id=10';




?>



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
				<table id="facility" class="table table-striped table-bordered table-responsive-md"  style="width:100%">
					<!--<thead>
							<th><h4>Question</h4></th>
							<th><h4>Answer</h4></th>
						</tr>
					</thead>-->
					<tbody>
					<?php 
						
						$i=1;$j=1;$k=1;
						$temp='';
						//print_r($viewquestion);
						foreach($viewquestion as $row) 
						{
						//print_r($viewquestion);
						   $categoryname = $row->categorytext;
							//print_r($categoryname);
							if($temp != $categoryname)
							{?>
								<tr><td colspan="2" class="text-center"><h5 style="font-weight: bold;"><?php echo $row->categorytext; ?></h5></td></tr>
								<?php
								$temp = $row->categorytext;
								
							}
					     ?>
					
				          <tr>
							<!--<td><?php echo $row->categorytext; ?></td>-->
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
									<td><input type="text" class="form-control" name="answer_<?php echo $i; ?>" <?php echo $req; ?> value="<?php echo @$row->answer; ?>">
									<input type="hidden" name="qid_<?php echo $i;?>" value="<?php  echo $row->questionid ?>"></td>
							<?php
									$i++;
								}
								
								if($row->qtype == "Upload") {
							?>
									<td><input type="file" name="file_<?php echo $j; ?>"  <?php echo $req; ?> value=""> 
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
										<select class="form-control" name="drpdwn_<?php echo $k;?>" <?php echo $req; ?> value="<?php echo @$row->answer; ?>">
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
	</div



<?php

 /*
	if ($generate) {
		$content = ob_get_contents(); // ob_get_clean();

		try {
			$html2pdf = new Html2Pdf('P', 'A4', 'fr');

		

			$html2pdf->writeHTML($content);
			$html2pdf->output('viewtier.pdf');
			exit;
		} catch (Html2PdfException $e) {
			$html2pdf->clean();

			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
			exit;
		}
	}

*/
?>

  
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script>
	$(document).ready(function() {
		$('.instructionlink').click(function() {
			var filename = $(this).data('instructionlink');
			if(filename.length >= 5) {
				$("#myModal").modal("show");
				var url = '<?php echo base_url()."upload/questioninstruction/"; ?>'+filename;
				jQuery('#myFrame').attr('src',url);
				jQuery('#myFrame').show();
			}else {
				alert('File not found');
			}
			
		});
	});
</script>
