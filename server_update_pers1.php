<?php include 'connectivity.php'?>
<?php

$Error = "";
$mis = "";
$fn = "";
$ln = "";
$mn = "";
$a1 = "";
$a2 = "";
$a3 = "";
$city = "";
$state = "";
$dis = "";
$pin = "";
$gn = "";
$dd = "";
$mm = "";
$yy = "";
$ffn = "";
$fln = "";
$mfn = "";
$mln = "";
$religion = "";
$caste = "";
$nat = "";
$pass = "";
$aadhar = "";
$pan = "";
$mob = "";
$email = "";

$date = "";
	session_start();

	$mis = $_SESSION['fmis'];
			
			$sql = "select * from faculty where mis = '$mis'";
			$result = mysqli_query($con,$sql);
			$row = $result->fetch_assoc();

			$sql1 = "select * from pers1 where mis = '$mis'";
			$result1 = mysqli_query($con,$sql1);
			$row1 = $result1->fetch_assoc();

			$sql2 = "select * from address where mis = '$mis'";
			$result2 = mysqli_query($con,$sql2);
			$row2 = $result2->fetch_assoc();
			
		
		if((mysqli_num_rows($result) == 1) && (mysqli_num_rows($result1) == 1) && (mysqli_num_rows($result2) == 1)){
			
			
			$fn = $row['fname'];			
			$ln = $row['lname'];
			$mob = $row['mobile'];
			$email = $row['email'];	
			
		
			$a1 = $row2['add1'];
			$a2 = $row2['add2'];		
			$a3 = $row2['add3'];
			$city = $row2['city'];	
			$state = $row2['state'];	
			$dis = $row2['district'];		
			$pin = $row2['pin'];	

			$mn = $row1['mname'];
			$gn = $row1['gender'];	

			$dob = $row1['dob'];
			$date = explode("-",$dob);
			$dd = $date[2];
			$mm = $date[1];
			$yy = $date[0];
			
			$ffn = $row1['father_fname'];
			$fln = $row1['father_lname'];		
			$mfn = $row1['mother_fname'];	
			$mln = $row1['mother_lname'];	
			$religion = $row1['religion'];
			$caste = $row1['caste'];
			$nat = $row1['nationality'];			
			$pass = $row1['passport_no'];	
			$aadhar = $row1['aadhar_no'];	
			$pan = $row1['pan_no'];	
		}
		else{
			$Error = "*MIS ".$mis." does not exist";
			$mis = "";
			$_SESSION['mis'] = "";
		}

	
	if(isset($_POST['save'])){
		
		$fn = $_POST['fname'];			
		$ln = $_POST['lname'];	
		$mn = $_POST['mname'];

		$mob = $_POST['mobile'];
		$email = $_POST['email'];
		
		$a1 = $_POST['add1'];
		$a2 = $_POST['add2'];		
		$a3 = $_POST['add3'];
		$city = $_POST['city'];	
		$state = $_POST['state'];	
		$dis = $_POST['district'];		
		$pin = $_POST['pincode'];	

		$gn = $_POST['gender'];	
		$dd = $_POST['day'];
		$mm = $_POST['month'];
		$yy = $_POST['year'];
		$dob = $yy."-".$mm."-".$dd;
		$ffn = $_POST['ffname'];
		$fln = $_POST['flname'];		
		$mfn = $_POST['mfname'];	
		$mln = $_POST['mlname'];	
		$religion = $_POST['religion'];
		$caste = $_POST['caste'];
		$nat = $_POST['nationality'];			
		$pass = $_POST['passport'];	
		$aadhar = $_POST['aadhar'];	
		$pan = $_POST['pan'];	

	//	$sql1 = "update faculty, pers1,address set fname='$fn',lname= '$ln',email = '$email', mobile = '$mob' where faculty.mis='$mis' and pers1.mis = '$mis' and address.mis = '$mis';";
	//	$result1 = mysqli_query($con,$sql1);

		$sql3 = "update faculty set fname='$fn',lname= '$ln',email = '$email', mobile = '$mob' where mis='$mis';";
		$sql4 = "update pers1 set mname = '$mn', gender = '$gn', dob = '$dob', father_fname = '$ffn', father_lname = '$fln', mother_fname = '$mfn', mother_lname = '$mln', religion = '$religion', nationality = '$nat', caste = '$caste', passport_no = '$pass', aadhar_no = '$aadhar', pan_no '$pan' where mis='$mis';";
		$sql5 = "update address set add1='$a1',add2='$a2',add3='$a3',city='$city',state ='$state',district='$dis',pin='$pin' where mis='$mis';";
		$result3 = mysqli_query($con,$sql3);
		$result4 = mysqli_query($con,$sql4);
		$result5 = mysqli_query($con,$sql5);

	

		if($result3 && $result4 && $result5){
			echo '<script type="text/javascript">alert("Update Successfull! ");</script>';
		} 
		else{
			echo '<script type="text/javascript">alert("Oops! Something went wrong went while updating. Sorry! ");</script>';
			if($result3){
			 echo "1";
			}
			if($result4){
			 echo "2";
			}

			if($result5){
			 echo "3";
			}


		}
	}
			
 
	if(isset($_POST['next'])){
		header('Location:update_pers2.php');
	}

	if(isset($_POST['back'])){
		header('Location:facultyH.php');
	}

	mysqli_close($con);
?>
