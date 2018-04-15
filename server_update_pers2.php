<?php
	session_start();
    include 'connectivity.php';

$Error = "";
$design = "";
$appt = "";
$prog = "";
$dj = "";
$mj = "";
$yj = "";
$course = "";
$qual = "";
$spec = "";
$mexp = "";
$yexp = "";

$bn = "";
$baccn = "";
$ifsc = "";

$date = "";
$mis = "";
$result = "";

	$mis = $_SESSION['fmis'];
	
			$row = mysqli_fetch_array(mysqli_query($con,"select * from college_design where mis = '$mis'"));

			$row1 = mysqli_fetch_array(mysqli_query($con,"select * from pers_quali where mis = '$mis'"));

			$row1 = mysqli_fetch_array(mysqli_query($con,"select * from fbank_details where mis = '$mis'"));

		if((mysqli_num_rows(mysqli_query($con,"select * from college_design where mis = '$mis'")) == 1) && (mysqli_num_rows(mysqli_query($con,"select * from pers_quali where mis = '$mis'")) == 1) && (mysqli_num_rows(mysqli_query($con,"select * from fbank_details where mis = '$mis'")) == 1)){
			
			
			$fn = $row['design'];			
			$ln = $row['apptype'];
			$mob = $row['program'];
			$email = $row['course'];	
			
		
			$a1 = $row2['spec'];
			$a2 = $row2['mexp'];		
			$a3 = $row2['yexp'];
			$city = $row2['bankname'];	
			$state = $row2['bankaccno'];	
			$dis = $row2['ifsc'];			

			$dob = $row1['doj'];
			$date = explode("-",$dob);
			$dj = $date[2];
			$mj = $date[1];
			$yj = $date[0];
			
		}
		else{
			$Error = "*MIS ".$mis." does not exist";
			$mis = "";
			$_SESSION['mis'] = "";
		}

		if(isset($_POST['save'])){

		$design = $_POST['design'];			
		$appt = $_POST['apptype'];	
		$prog = $_POST['program'];
		$dj = $_POST['dayj'];
		$mj = $_POST['monthj'];
		$yj = $_POST['yearj'];
		$doj = $yj."-".$mj."-".$dj;

		$qual = $_POST['qual'];		
		$spec = $_POST['spec'];
		$mexp = $_POST['mexp'];	
		$yexp = $_POST['yexp'];
	
		$bn = $_POST['bankname'];		
		$baccn = $_POST['bankaccno'];	
		$ifsc = $_POST['ifsc'];		

	//	$sql1 = "update faculty, pers1,address set fname='$fn',lname= '$ln',email = '$email', mobile = '$mob' where faculty.mis='$mis' and pers1.mis = '$mis' and address.mis = '$mis';";
	//	$result1 = mysqli_query($con,$sql1);

		$sql3 = "update college_design set design ='$design', apptype = '$appt', prog = '$prog', doj = '$doj', cousre = '$course' where mis='$mis';";
		$sql4 = "update pers_quali set quali = '$qual', area_special = '$spec', exp_months = '$mexp', exp_years = '$yexp' where mis='$mis';";
		$sql5 = "update fbank_details set bank_name='$bn',bank_accno='$baccn',ifsc='$ifsc' where mis='$mis';";
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
        if(isset($_POST['back'])){
        		header('Location:facultyH.php');
        	}
        if(isset($_POST['done'])){
        		header('Location:facultyH.php');
        }

	mysqli_close($con);
?>


