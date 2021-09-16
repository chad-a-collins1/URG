<section role="main" class="content-body">
	<header class="page-header">
		<h2>Add Question Type</h2>
	
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add Question Type</span></li>
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
					<h2 class="panel-title">Question Type</h2>
				</header>
				
				<div class="panel-body">
					<form class="form-horizontal form-bordered" method="POST">
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Question Type</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="question_type">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Field Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="field_name">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="inputDefault"></label>
							<div class="col-md-6">
								<button type="submit" name="add_questiontype" class="btn btn-primary theme_btn">Add</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>
					<h2 class="panel-title">All Question Type</h2>
				</header>
				
				<div class="panel-body">
					<table id="questiontype"></table>
					<div id="question_type_page"></div>
				</div>
			</section>
		</div>
	</div>
	
</section>
<script>
$(document).ready(function() {

	$("#questiontype").jqGrid({
		url:'<?php echo base_url(); ?>Admin/view_questiontype_api',
		datatype: "json",
		mtype: "GET",
		colModel: [
			{ name: "qtype" },
			{ name: "fieldname" }
		],
		
		
		// data: bodyJson,
		loadonce: true,
		height: 200,
		iconSet: "fontAwesome",
		idPrefix: "g_",
		rownumbers: true,
		sortname: "invdate",
		sortorder: "desc",
		threeStateSort: true,
		// sortIconsBeforeText: true,
		headertitles: true,
		// toppager: true,
		// pager: true,
		"autowidth" : true,
		pager: "#question_type_page",
		rowNum: 5,
		// viewrecords: true,
		searching: {
			defaultSearch: "cn"
		},
		
	}).jqGrid("filterToolbar");
				
});
 
</script>

	</section>