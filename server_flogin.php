<?php
	session_start();
	include 'connectivity.php';

$Error = "";
$mis = "";
$paw = "";

	if(isset($_POST['login-submit'])){
		$mis = $_POST['mis'];
		$paw = $_POST['password'];

		$sql = "select * from login where mis = '$mis' ";
		$sql1 = "select * from requested where mis = '$mis' ";		

		$result = mysqli_query($con,$sql);
		$row = $result->fetch_assoc();
		$result1 = mysqli_query($con,$sql1);
		$row1 = $result1->fetch_assoc();
		
		$x = $row['status'];
		$x1 = $row1['status'];
	
		if((mysqli_num_rows($result) == 1) && ($x == 1) ){
			if($paw == $row['password']){
				$_SESSION['mis'] = $mis;
				$_SESSION['fmis'] = $mis;
				$_SESSION['password'] = $paw;
				header('Location:facultyH.php');
			}
			else{
				echo '<script type="text/javascript">alert("Incorrect Password");</script>';
					
			}
		}

		else if ((mysqli_num_rows($result) != 1) && ($x == 1)){
			echo '<script type="text/javascript">alert("Check MIS or Password");</script>';	
					
		}

		if((mysqli_num_rows($result1) == 1) && ($x1 == 0) ){
			if($paw == $row1['password']){
				echo '<script type="text/javascript">alert("Unable to Login. Admin has not approved of your request yet.");</script>';
				
			}
			else{
				echo '<script type="text/javascript">alert("Incorrect Password ");</script>';	
						
			}
			
		}
		else if ((mysqli_num_rows($result) != 1) && (mysqli_num_rows($result1) != 1) && ($x1 == 0)){
			echo '<script type="text/javascript">alert("Check MIS or Password");</script>';	
			
					
		}
		


	}

	
	if(isset($_POST['adminlogin'])){
		header('Location:adminlogin.php');
	}


	
	mysqli_close($con);


?>
