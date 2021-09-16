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
			<header><strong><h1>Payment</strong></h1></header>
		</div>
	</div>
	<div class="row" style="margin-top: 30px;">
		<div class="col-md-12">
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Name on the card</label>
				<div class="col-sm-4">
					<input type="text" name="name" class="form-control" >
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Card Number</label>
				<div class="col-sm-4">
					<input type="text" name="card_no" class="form-control" >
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">CVV Number</label>
				<div class="col-sm-4">
					<input type="text" name="cvv_no" class="form-control" >
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Expiry date</label>
				<div class="col-sm-4">
					<select name="month">
					<option>1</option>
					<option>2</option>
					<option>3</option>
				    <option>4</option>
				  	<option>5</option>	
					<option>6</option>
                 	<option>7</option>
                 	<option>8</option>
                 	<option>9</option>
                 	<option>10</option>
                 	<option>11</option>
                 	<option>12</option>
                   </select>
				   <select name="year">
				   	<option>2020</option>
				   	<option>2021</option>
				   	<option>2022</option>
				   	<option>2023</option>
				   	<option>2024</option>
				   	<option>2025</option>
				   	<option>2026</option>
				   	<option>2027</option>
				   	<option>2028</option>
				   	<option>2029</option>
				   	<option>2030</option>
				   </select>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Zip Code</label>
				<div class="col-sm-4">
					<input type="text" name="zip_code" class="form-control" >
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label class="col-sm-2 col-form-label">Amount</label>
				<div class="col-sm-4">
					<input type="text" name="amount" class="form-control" required>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<div class="col-sm-6">
					<button type="submit" name="payment" class="btn btn-primary theme_btn">Payment</button>
				</div>
			</div>
		</form>
		</div>
	</div>
			