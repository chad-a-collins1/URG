<section role="main" class="content-body">
	<header class="page-header">
		<h2>Add Question</h2>
	
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Admin/dashbord'); ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add Question</span></li>
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
					<h2 class="panel-title">Add Question</h2>
				</header>
				
				<div class="panel-body">
					<form class="form-horizontal form-bordered" method="POST">
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Tier</label>
							<div class="col-md-6">
								<select class="form-control input-sm mb-md" name="tier">
								<?php 
									if(isset($_GET['tier_id'])) {
										$tier_id = $_GET['tier_id'];
									}
									$sel="";
									foreach($tier_data as $tier) { 
										if($tier['tierid'] == $tier_id) {
											$sel = "selected";
										}
								?>
									<option value="<?php echo $tier['tierid']; ?>" <?php echo $sel; ?>><?php echo $tier['description']; ?></option>
								<?php 
										$sel="";
									}
								?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Question</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="question_text">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Question Category</label>
							<div class="col-md-6">
								<select class="form-control input-sm mb-md" name="question_category">
								<?php 
									foreach($question_categories as $question_category) { 
								?>
									<option value="<?php echo $question_category['categoryid']; ?>"><?php echo $question_category['categorytext']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Service Type</label>
							<div class="col-md-6">
								<select class="form-control input-sm mb-md" name="service_type">
								<?php 
									foreach($services as $service) { 
								?>
									<option value="<?php echo $service['serviceid']; ?>"><?php echo $service['servicetype']; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
							<label class="col-md-3 control-label" for="inputDefault">Question Type</label>
							<div class="col-md-6">
								<select class="form-control input-sm mb-md" name="question_type" id="question_type">
								<?php 
									foreach($questiontype as $question_type) { 
								?>
									<option value="<?php echo $question_type['id']; ?>"><?php echo $question_type['qtype']; ?></option>
								<?php } ?>
								</select>
							</div>
							</div>
							<div class="row" id="drop_down_row" style="display: none;">
								<label class="col-md-3 control-label" for="inputDefault"></label>
								<div class="col-md-6">
									<p>Enter Dropdown value seperated by comma(,).</p>
									<input type="text" class="form-control" name="question_type_dropdown">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="inputDefault"></label>
							<div class="col-md-6">
								<button type="submit" name="add_question" class="btn btn-primary theme_btn">Add</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
	
</section>
<script>
$(document).ready(function(){
	
	$('#question_type').change(function() {
		var value = $(this).val();
		if(value == 6){
			$("#drop_down_row").show();
		}else {
			$("#drop_down_row").hide();
		}
	});
	
});
</script>