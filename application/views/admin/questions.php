<?php 
	if(isset($_GET['id'])) {
		$tier_id = $_GET['id'];
	} else {
		$tier_id = $tier_data[0]['tierid'];
	}
?>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Questions</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Questions</span></li>
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>
					<h2 class="panel-title">All Questions</h2>
				</header>
				
				<div class="panel-body">
				<?php //print_r($tier_data); ?>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				<?php
					$active_li = "";
					foreach($tier_data as $key=>$tier) {
						if($tier['tierid'] == $tier_id) {
							$active_li = "active";
						}
				?>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_li; ?>" id="tier-tab-<?php echo $tier['tierid']; ?>" href="<?php echo base_url().'Admin/questions?id='.$tier['tierid']; ?>" role="tab" aria-controls="tier_<?php echo $tier['tierid']; ?>" aria-selected="false"><?php echo $tier['description']; ?></a>
						</li>
				<?php
						$active_li = "";
					}
				?>
				</ul>
				<div class="tab-content" id="myTabContent">
				<?php
					$active = "";
				?>	
					<div class=" <?php echo $active; ?>" id="tier">
						<div class="row">
							<form method="GET">
								<div class="col-md-4">
									<select class="form-control" name="category">
										<option value="all">All Category</option>
									<?php 
										foreach($categories as $category) {
									?>
											<option value="<?php echo $category['categoryid']; ?>"><?php echo $category['categorytext']; ?></option>
									<?php
										}
									?>
									</select>
									<input type="hidden" name="id" value="<?php echo @$_GET['id']?$_GET['id'] : $tier_data[0]['tierid']; ?>" >
								</div>
								<div class="col-md-4">
									<input type="submit" class="btn btn-primary" name="categoryBtn" value="Submit">
								</div>
							</form>
							<div class="col-md-4" style="margin-bottom:20px;">
								<a href="<?php echo base_url().'Admin/add_question?tier_id='.$tier['tierid']; ?>" class="btn btn-primary align-self-end" style="float: right;">Add Question</a>
							</div>
						</div>
						<table id="tier_tbl"></table>
						<div id="tierPager"></div>
						<input type="BUTTON" class="btn btn-primary" id="bedata" value="Edit Selected Row" style="margin-top:30px;" />
					</div>
				<?php
						$active= "";
				?>
				</div>
				</div>
				
			</section>
		</div>
	</div>
	
</section>

<!-- Button trigger modal -->
<!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editdataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 0px 41px 20px;">
				<div class="col-sm-10">
					<h3 class="modal-title" id="exampleModalLabel">Edit Data</h3>
				</div>
				<div class="col-sm-2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>Admin/UpdateQuestion">
			<div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-4 col-form-label"><b>Question</b></label>
					<div class="col-sm-8">
						<input type="text" name="question" class="form-control" id="question" value="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label"><b>Question Type</b></label>
					<div class="col-sm-8">
						<select class="form-control" name="questiontype" id="questiontype">
						<?php
							foreach($questiontype as $type) {
								echo "<option value=".$type['id'].">".$type['qtype']."</option>";
							}
						?>
						</select>
						<input type="text" style="margin-top:10px;" class="form-control" name="dropdown_category" id="dropdown_category" value="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label"><b>Instruction</b></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="instructiontext" id="instructiontext" value="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label"><b>Instruction File name</b></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="instructionfilename" value="" readonly>
						<input type="file" class="form-control-file" name="instructionlink" style="margin-top: 10px;" id="instructionlink">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4"><b>Required</b></div>
					<div class="col-sm-8">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="required" id="required" value="1" />
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" class="form-control" name="questionid" id="questionid" value="">
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	
	var lastsel;
	var id_str = "#tier";
	$(id_str).tab('show') // Select tab by name
	
	var bodyJson = <?php print_r($question_data); ?>;
	// console.log(bodyJson);
	
	$("#tier_tbl").jqGrid({
		colNames:['Id','Questions', 'Order', 'Dropdown Option', 'Instruction', 'Instruction File Name', 'Required', 'Qusrtion Type'],
		colModel: [
			{name:'questionid',index:'questionid', width:55, editable: true, hidden:true, editoptions:{readonly:true}},
			{ name: "question", label: "Questions", editable: false},
			{ name: "question_order", label: "Order", editable: true },
			{ name: "dropdown_category", label: "Dropdown Option", width:100,  editable: false },
			{ name: "instructiontext", label: "Instruction",  width:100, editable: false },
			{ name: "instructionlink", label: "Instruction File Name", editable: false },
			{ name: "required", label: "Required",  width:50, editable: false },
			{ name: "questiontype", label: "Qusrtion Type", hidden:true,  width:50, editable: false },
			// {name:'act',index:'act', width:75,sortable:false}
		],
		data: bodyJson ,
		loadonce: true,
		height: 400,
		iconSet: "fontAwesome",
		// idPrefix: "g_",
		rownumbers: true,
		// sortname: "invdate",
		sortname: 'id',
		sortorder: "desc",
		threeStateSort: true,
		sortIconsBeforeText: true,
		headertitles: true,
		// toppager: true,
		pager: true,
		"autowidth" : true,
		pager: "#tierPager",
		rowNum: 12,
		viewrecords: true,
		editurl: "<?php echo base_url(); ?>/Admin/editquestion_API",
		searching: {
			defaultSearch: "cn"
		},
		pgbuttons: true,
		onSelectRow: function(id){
			if(id && id!==lastsel){
				jQuery('#tier_tbl').jqGrid('restoreRow',lastsel);
				jQuery('#tier_tbl').jqGrid('editRow',id,true);
				lastsel=id;
			}
		},
	}).jqGrid('filterToolbar',"#tierPager",{edit:true ,add:false,del:false});
	
	
	$("#bedata").click(function(){
		var gr = jQuery("#tier_tbl").jqGrid('getGridParam','selrow');
		if( gr != null ){
			var question_id = jQuery("#"+gr).children('td:nth-child(1)').text();
			// alert(question_id);
			var question = jQuery("#"+gr).children('td:nth-child(3)').text();
			var questionType = jQuery("#"+gr).children('td:nth-child(9)').text();
			var dropdown_category = jQuery("#"+gr).children('td:nth-child(5)').text();
			var instructiontext = jQuery("#"+gr).children('td:nth-child(6)').text();
			var instructionFileName = jQuery("#"+gr).children('td:nth-child(7)').text();
			var required = jQuery("#"+gr).children('td:nth-child(8)').text();
			
			$('#questionid').val(question_id);
			$('#question').val(question);
			$('#questiontype').val(questionType);
			$('#dropdown_category').val(dropdown_category);
			$('#instructiontext').val(instructiontext);
			$('#instructionfilename').val(instructionFileName);
			
			var questiontypeid = $('#questiontype').val();
			// alert(questiontypeid);
			if(questiontypeid == 6) {
				$('#dropdown_category').show();
			}else {
				$('#dropdown_category').hide();
			}
			
			if(required == 1){
				$("#required"). prop("checked", true);
			}else {
				$("#required"). prop("checked", false);
			}
			
			$('#editdataModal').modal('show');
		}
		else {
			alert("Please Select Row");
		}
	});
	
	$("#questiontype").change(function(){
		var questiontype = $('#questiontype').val();
		// alert(questiontype);
		if(questiontype == 6) {
			$('#dropdown_category').show();
		}else {
			$('#dropdown_category').hide();
		}
	});
	
				
});
 
</script>