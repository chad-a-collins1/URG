<div class="container">
	<div class="row" style="margin-top:30px;">
		<div class="col-md-3" style="color:green;">
			<h1>URG</h1>
			<p>BY RECYCLERS | FOR RECYCLERS</p>
		</div>
	</div>
	
	<div class="row" style="margin-top:30px;">
		<div class="col-md-12 text-center" style="color:#434544;">
			<h1>Authorized Facilities</h1>
		</div>
	</div>
	
	<div class="row" style="margin-top: 30px;">
		<div class="col-md-12">
		<form method="POST">
			<div class="form-group row justify-content-center">
				<div class="col-md-6 text-center">
					<a href="<?php echo base_url().'User/add_facility'; ?>" class="btn btn-primary theme_btn">Add a New Facility</a>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Choose a state</label>
				<div class="col-sm-4">
					<select name="state" class="form-control">
						<option selected value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Choose a facility</label>
				<div class="col-sm-4">
					<select name="facility" class="form-control">
						<option selected value="...">...</option>
						<option value="...">...</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Choose a tier</label>
				<div class="col-sm-4">
					<select name="tier" class="form-control">
						<option selected value="...">...</option>
						<option value="...">...</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<div class="col-sm-6">
					<button type="submit" name="add" class="btn btn-primary theme_btn">Submit</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>