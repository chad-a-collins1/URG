<section role="main" class="content-body">
	<header class="page-header">
		<h2>Tier</h2>
	
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Tier</span></li>
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
					<h2 class="panel-title">Add Tier</h2>
				</header>
				
				<div class="panel-body">
					<form class="form-horizontal form-bordered" method="POST">
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Tier Text</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="tier_text">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="inputDefault"></label>
							<div class="col-md-6">
								<button type="submit" name="add_tier" class="btn btn-primary theme_btn">Add</button>
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
					<h2 class="panel-title">All Tier </h2>
				</header>
				
				<div class="panel-body">
					<table id="tier_tbl"></table>
					<div id="tier_page"></div>
				</div>
			</section>
		</div>
	</div>
	
</section>

<script>
$(document).ready(function() {

	$("#tier_tbl").jqGrid({
		url:'<?php echo base_url(); ?>Admin/view_tier_api',
		datatype: "json",
		mtype: "GET",
		colModel: [
			{ name: "description", label: "Tier" }
		],
		// data: bodyJson,
		loadonce: true,
		// height: 200,
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
		pager: "#tier_page",
		rowNum: 5,
		// viewrecords: true,
		searching: {
			defaultSearch: "cn"
		},
		
	}).jqGrid("filterToolbar");
				
});
 
</script>