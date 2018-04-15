<?php include 'connectivity.php'?>
<?php

$Error = "";
$mis = "";
$fn = "";
$ln = "";
$email = "";
$mob = "";
$paw = "";
$count = 0;

	
	if(isset($_POST['register-submit'])){
		$mis = $_POST['mis'];

		$fn = $_POST['fname'];			
		$ln = $_POST['lname'];	
		$mob = $_POST['mobile'];
		$email = $_POST['email'];
		$paw = $_POST['password'];
	

		$sql = "INSERT INTO requested (mis, fname, lname, email, mobile, password)VALUES ('$mis', '$fn', '$ln', '$email', '$mob', '$paw')";
		$result = mysqli_query($con,$sql);
		


		if($result){
			echo '<script type="text/javascript">alert("Requested Admin to accept registration!");</script>';
			
		} 
		else{
			echo '<script type="text/javascript">alert("Oops! Something went wrong. Please try later. ");</script>';
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
			
		}
	}


mysqli_close($con);

?>




