<?php
	session_start();
	include 'connectivity.php';

	$Error = "";
	$mis = "";
	$apaw = "";

	if(isset($_POST['adminlogin-submit'])){
		$mis = $_POST['mis'];
		$apaw = $_POST['password'];

		$sql = "select * from login_admin where id = '$mis' ";
				
		$result = mysqli_query($con,$sql);
		$row = $result->fetch_assoc();
	
		if(mysqli_num_rows($result) == 1){
			if($apaw == $row['password']){
				$_SESSION['id'] = $mis;
				$_SESSION['password'] = $apaw;
				header('Location:adminH.php');
			}
			else{
				echo '<script type="text/javascript">alert("Incorrect Password");</script>';					
			}
		}
		else {
			echo '<script type="text/javascript">alert("Check MIS or Password");</script>';				
		}
	}

	if(isset($_POST['adminlogin_back'])){
		header('Location:login.php');
	}

mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Patram</title>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<script>
		$(function() {

			$('#adminlogin-form-link').click(function(e) {
				$("#adminlogin-form").delay(100).fadeIn(100);
				$(this).addClass('active');
				e.preventDefault();
			});


		});
	</script>
	<style>
		body {
			padding-top: 90px;
		}
		.panel-login {
			border-color: #ccc;
			-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
			-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
			box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
		}
		.panel-login>.panel-heading {
			color: #00415d;
			background-color: #fff;
			border-color: #fff;
			text-align:center;
		}
		.panel-login>.panel-heading a{
			text-decoration: none;
			color: #666;
			font-weight: bold;
			font-size: 15px;
			-webkit-transition: all 0.1s linear;
			-moz-transition: all 0.1s linear;
			transition: all 0.1s linear;
		}
		.panel-login>.panel-heading a.active{
			color: #029f5b;
			font-size: 18px;
		}
		.panel-login>.panel-heading hr{
			margin-top: 10px;
			margin-bottom: 0px;
			clear: both;
			border: 0;
			height: 1px;
			background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
			background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
			background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
			background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
		}
		.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
			height: 45px;
			border: 1px solid #ddd;
			font-size: 16px;
			-webkit-transition: all 0.1s linear;
			-moz-transition: all 0.1s linear;
			transition: all 0.1s linear;
		}
		.panel-login input:hover,
		.panel-login input:focus {
			outline:none;
			-webkit-box-shadow: none;
			-moz-box-shadow: none;
			box-shadow: none;
			border-color: #ccc;
		}
		.btn-login {
			background-color: #59B2E0;
			outline: none;
			color: #fff;
			font-size: 14px;
			height: auto;
			font-weight: normal;
			padding: 14px 0;
			text-transform: uppercase;
			border-color: #59B2E6;
		}
		.btn-login:hover,
		.btn-login:focus {
			color: #fff;
			background-color: #53A3CD;
			border-color: #53A3CD;
		}
		.forgot-password {
			text-decoration: underline;
			color: #888;
		}
		.forgot-password:hover,
		.forgot-password:focus {
			text-decoration: underline;
			color: #666;
		}

		.btn-register {
			background-color: #1CB94E;
			outline: none;
			color: #fff;
			font-size: 14px;
			height: auto;
			font-weight: normal;
			padding: 14px 0;
			text-transform: uppercase;
			border-color: #1CB94A;
		}
		.btn-register:hover,
		.btn-register:focus {
			color: #fff;
			background-color: #1CA347;
			border-color: #1CA347;
		}
	</style>

</head>
<body>

<form id="adminlogin-form" action="adminlogin.php" method="post" role="form" style="display: block;">
<div class="container" align="right" height="300px" >
	<button type="submit" name="adminlogin_back" class="btn btn-link">Back</button>  
</div>
</form>

<div class="container" align="center" height="100px" >
	<h1>Patram</h1>      
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<a href="#" class="active" id="login-form-link">Admin Login</a>
						</div>
						<div class="col-xs-6">
							<label>&#160;</label>
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
					
							<form id="forgetpass-form" action="adminlogin.php" method="post" role="form" style="display: block;">
								<div class="form-group">
									<input type="text" name="mis" id="mis" tabindex="1" class="form-control" placeholder="Admin MIS" value="<?php echo $mis; ?>">
								</div>
								<div class="form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php echo $apaw; ?>">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="adminlogin-submit" id="adminlogin-submit" tabindex="4" class="form-control btn btn-login" value="Login">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



</div>
</body>
</html>



