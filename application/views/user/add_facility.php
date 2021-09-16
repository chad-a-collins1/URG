<div class="container">
	<div class="row" style="margin-top:30px;">
		<div class="col-md-3" style="color:green;">
			<h1>URG</h1>
			<p>BY RECYCLERS | FOR RECYCLERS</p>
		</div>
	</div>
	
	<div class="row" style="margin-top:30px;">
		<div class="col-md-12 text-center" style="color:#434544;">
			<h1>Add A New Facility</h1>
		</div>
	</div>
	
	<div class="row text-center" style="background-color: #0e7554; color: #fff; padding: 10px 30px; font-size: 18px; margin-top:20px; margin-bottom: 30px;">
		<div class="col-md-12">
			<p>All facilities using a preparer must complete the authorization page before any certifications can be completed</p>
		</div>
	</div>
	
	<div class="row" style="margin-top: 30px;">
		<div class="col-md-12">
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Facility Name</label>
				<div class="col-sm-4">
					<input type="text" name="facility_name" class="form-control" value="<?php echo @$facilitydata[0]['facilityname'] ?>">
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Facility state</label>
				<div class="col-sm-4">
					<select name="facility_state" class="form-control">
                                               <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District Of Columbia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Facility Permit Number</label>
				<div class="col-sm-4">
					<input type="text" value="<?php echo @$facilitydata[0]['permitnumber'] ?>" name="facility_permit_number" class="form-control">
				</div>
			</div>
			<div class="input-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Upload authorization page</label>
				<div class="col-sm-4">
					<input type="file" name="file_page" class="form-control">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script src="<?php echo base_url();?>assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vendor/bootstrap.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
$(function() {
       $('#sbumitiondate').datepicker({
           dateFormat: "yy-mm-dd"
       });
	   
	   $('#expirationdate').datepicker({
           dateFormat: "yy-mm-dd"
       });
    });
</script>