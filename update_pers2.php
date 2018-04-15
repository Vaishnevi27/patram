<?php include 'server_update_pers2.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faculty Update</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

<div class="container">
    <h1 class="well">Personal Details</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form  method='POST' action="update_pers2.php">
					<div class="col-sm-12">
						<div class="row">
						<div class="col-sm-12 form-group">
								<label>Designation</label>
								<input type="text" name="design" placeholder="Designation" class="form-control" value="<?php echo $design; ?>">
						</div>

						<div class="col-sm-12 form-group">
								<label>Appointment Type</label>
								<input type="text" name="apptype" placeholder="Appointment Type" class="form-control" value="<?php echo $appt; ?>">
						</div>
						</div>
				
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Program</label><br>
								<input type="radio" name="program" value="engg" <?php echo ($prog == "male")?' checked':'' ?> checked> Engineering<br>
								<input type="radio" name="program" value="diploma" <?php echo ($prog == "male")?' checked':'' ?>> Diploma<br>
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160;  </label>
								
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160;  </label>
								
							</div>
						</div>

						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Date Of Joining </label>
								<div class="row">
									<div class="col-sm-4 form-group">
										<input type="number" class="form-control" min="1" max="31" name="dayj" placeholder="dd" value="<?php echo $dj; ?>">
									</div>
									<div class="col-sm-4 form-group">
										<input type="number" class="form-control" min="1" max="12" name="monthj" placeholder="mm" value="<?php echo $mj; ?>">
									</div>
								
									<div class="col-sm-4 form-group">
										<input type="number" class="form-control" min="1900" max="2017" name="yearj" placeholder="yyyy" value="<?php echo $yj; ?>">
									</div>
								</div>
								
							</div>

							<div class="col-sm-4 form-group">
								<label>&#160;  </label>
								
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160;  </label>
								
							</div>
						</div>		

						<div class="row">
						 
						<div class="col-sm-12 form-group">
								<label>Course</label>
								<input class="form-control" name="course" type="text" placeholder="Computer/IT" value="<?php echo $course; ?>" disabled >
						</div>

						<div class="col-sm-12 form-group">
								<label>Qualification</label>
								<input type="text" name="qual" placeholder="Qualification" class="form-control" value="<?php echo $qual; ?>">
						</div>
						<div class="col-sm-12 form-group">
								<label>Area of Speacialization</label>
								<input type="text" name="spec" placeholder="Area of Speacialization" class="form-control" value="<?php echo $spec; ?>">
						</div>	
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Experience</label><br>
								<input type="text" name="mexp" placeholder="Number of Months" class="form-control" value="<?php echo $mexp; ?>">
								
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160; </label><br>
								<input type="text" name="yexp" placeholder="Number of Years" class="form-control" value="<?php echo $yexp; ?>">
							</div>
							<div class="col-sm-4 form-group">
								<label>&#160;  </label>
								
							</div>
						</div>	
						<div class="row">
							<div class="col-sm-12 form-group">
								<label>Bank Name</label>
								<input type="text" name="bankname" placeholder="Bank Name" class="form-control" value="<?php echo $bn; ?>">
							</div>
							<div class="col-sm-12 form-group">
								<label>Bank Account Number</label>
								<input type="text" name="bankaccno" placeholder="Bank Account Number" class="form-control" value="<?php echo $baccn; ?>">
							</div>
							<div class="col-sm-12 form-group">
								<label>IFSC Code</label>
								<input type="text" name="ifsc" placeholder="IFSC Code" class="form-control" value="<?php echo $ifsc; ?>">
							</div>	
						</div>
					
					<button type="submit" name="done" style="float: right" class="btn btn-lg btn-info">Done</button>					

					<button type="submit" name="save" style="float: right" class="btn btn-lg btn-info">Save Changes</button>					
					<button type="submit" class="btn btn-lg btn-info" name="back" data-toggle="tooltip" title="All data of this page will be lost">Back</button>
										
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
