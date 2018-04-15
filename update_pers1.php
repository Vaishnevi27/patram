<?php include 'server_update_pers1.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faculty Upadate</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

<div class="container">
    <h1 class="well">Personal Details</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form  method='POST' action="update_pers1.php">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>MIS</label>
								<input type="text" name="f_mis" placeholder="MIS" class="form-control" value="<?php echo $mis; ?>" disabled>
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160; </label>
							</div>
								
							<div class="col-sm-4 form-group">
								<label>&#160; </label>
							</div>
						</div>	
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>First Name</label>
								<input type="text" name="fname" placeholder="First Name" class="form-control" value="<?php echo $fn; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>Last Name</label>
								<input type="text" name="lname" placeholder="Last Name" class="form-control" value="<?php echo $ln; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>Middle Name</label>
								<input type="text" name="mname" placeholder="Middle Name" class="form-control" value="<?php echo $mn; ?>">
							</div>
						</div>		
						
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Address</label>
								<div class="row">
								<input type="text" name="add1" placeholder="Line 1" rows="1" class="form-control" value="<?php echo $a1; ?>">
								</div>
								<div class="row">
								<input type="text" name="add2" placeholder="Line 2" rows="1" class="form-control" value="<?php echo $a2; ?>">
								</div>
								<div class="row">
								<input type="text" name="add3" placeholder="Line 3" rows="1" class="form-control" value="<?php echo $a3; ?>">
								</div>
							</div>	
						
							<div class="col-sm-4 form-group">
								<label>City</label>
								<input type="text" name="city" placeholder="City" class="form-control" value="<?php echo $city; ?>">
				
								<label>State</label>
								<input type="text" name="state" placeholder="State" class="form-control" value="<?php echo $state; ?>">
							</div>	
							<div class="col-sm-4 form-group">
								<label>District</label>
								<input type="text" name="district" placeholder="District" class="form-control" value="<?php echo $dis; ?>">

								<label>PinCode</label>
								<input type="text" name="pincode" placeholder="Pin Code" class="form-control" value="<?php echo $pin; ?>">
							</div>		
						</div>

						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Mobile</label>
								<input type="text" name="mobile" placeholder="Moile" class="form-control" value="<?php echo $mob; ?>">
							</div>
							<div class="col-sm-6 form-group">
								<label>Email</label>
								<input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
							</div>

						</div>	
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Gender</label><br>
								<input type="radio" name="gender" value="male" <?php echo ($gn == "male")?' checked':'' ?> checked> Male<br>
								<input type="radio" name="gender" value="female" <?php echo ($gn == "female")?' checked':'' ?>> Female<br>
							</div>
							<div class="col-sm-4 form-group">
								<label>Date Of Birth </label>
								
								
								<div class="row">
									<div class="col-sm-4 form-group">
										<input type="number" class="form-control" min="1" max="31" name="day" placeholder="dd" value="<?php echo $dd; ?>"><br>
									</div>
									<div class="col-sm-4 form-group">
										<input type="number" class="form-control" min="1" max="12" name="month" placeholder="mm" value="<?php echo $mm; ?>">
									</div>
								
									<div class="col-sm-4 form-group">
										<input type="number" class="form-control" min="1900" max="2017" name="year" placeholder="yyyy" value="<?php echo $yy; ?>">
									</div>
								</div>
								
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160;  </label>
								
							</div>
						</div>		
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Father's Name</label>
								<input type="text" name="ffname" placeholder="First Name" class="form-control" value="<?php echo $ffn; ?>">
							</div>		
							<div class="col-sm-6 form-group">
								<label> &#160;   </label>
								<input type="text" name="flname" placeholder="Last Name" class="form-control" value="<?php echo $fln; ?>">
							</div>	
						</div>	
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Mother's Name</label>
								<input type="text" name="mfname" placeholder="First Name" class="form-control" value="<?php echo $mfn; ?>">
							</div>		
							<div class="col-sm-6 form-group">
								<label>&#160;   </label>
								<input type="text" name="mlname" placeholder="Last Name" class="form-control" value="<?php echo $mln; ?>">
							</div>	
						</div>	
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Religion</label>
								<input type="text" name="religion" placeholder="Religion" class="form-control" value="<?php echo $religion; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>Caste</label>
								<input type="text" name="caste" placeholder="Caste" class="form-control" value="<?php echo $caste; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>Nationality</label>
								<input type="text" name="nationality" placeholder="Nationality" class="form-control" value="<?php echo $nat; ?>">
							</div>
						</div>	
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Passport Number</label>
								<input type="text" name="passport" placeholder="Passport Number" class="form-control" value="<?php echo $pass; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>Aadhar Number</label>
								<input type="text" name="aadhar" placeholder="Aadhar Number" class="form-control" value="<?php echo $aadhar; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>Pan Number</label>
								<input type="text" name="pan" placeholder="Pan Number" class="form-control" value="<?php echo $pan; ?>">
							</div>
						</div>
						
					<div>
					<button type="submit" name="back" data-toggle="tooltip" title="All data of this page will be lost" class="btn btn-lg btn-info">Back</button>
					<button type="submit" name="next" style="float: right" class="btn btn-lg btn-info">Next</button>					

					<button type="submit" name="save" style="float: right" class="btn btn-lg btn-info">Save Changes</button>					
					
					</div>
					</div>
				</form> 
				</div>
	</div>
	</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
