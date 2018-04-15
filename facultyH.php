<?php
	session_start();
	include 'connectivity.php';
	$mis = $_SESSION['mis'];


	$sql = "select * from messages where mis ='$mis'";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	$status = "";

	$success = "";
	$err = "";
	$title = "";
	$type = "";
	$date_on_doc = "";
	$date_of_upload = "";
	
	if(isset($_POST['upload'])){
		$title = $_POST['title'];
		$type = $_POST['type'];
		$date_of_upload = date('Y-m-d H:i:s');
		$date_on_doc = $_POST['date'];
		$description = $_POST['description'];
		
		$target_dir = "uploads/";
		$filename = basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$fileType = $_FILES["fileToUpload"]["type"];

		// Check if file already exists
		if (file_exists($target_file)) {
			$err .= "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$err .= "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($fileType != "image/jpg" && $fileType != "image/png" && $fileType != "image/jpeg" && $fileType != "image/gif" && $fileType != "application/pdf" && $fileType != "application/doc" && $fileType != "application/odt" && $fileType != "application/docx" && $fileType != "application/txt" && $fileType != "application/rtf" ) {
			$err .= "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, ODT, DOCX, TXT and RTF files are allowed.";
			$uploadOk = 0;
		}

		if ($uploadOk != 1) {
			$err .= "Sorry, your file was not uploaded.";
		} 
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$success .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been successfully uploaded.";
				$sql = "insert into uploads (mis, title, type, date_on_doc, date_of_upload, location, description) values ('$mis', '$title', '$type', '$date_on_doc', '$date_of_upload', '$filename','$description')";
				$result = mysqli_query($con,$sql);	
			} 
			else {
				$err .= "Sorry, there was an error uploading your file.";
			}
		}
		if($err != ""){
			$status = "<h3 class='bg-danger' align='center'> ".$err." </h3>";			
		}
		else{
			$status = "<h3 class='bg-success' align='center'> ".$success." </h3>";					
		}
	}
	if(isset($_POST['draft'])){
		$title = $_POST['title'];
		$type = $_POST['type'];
		$date_of_upload = date('Y-m-d H:i:s');
		$date_on_doc = $_POST['date'];
		if($date_on_doc == "0000-00-00"){
            $date_on_doc == "1950-01-01";
		}
		$description = $_POST['description'];
		$filename = basename($_FILES["fileToUpload"]["name"]);

		$sql = "insert into drafts (mis, title, type, date_on_doc, date_of_upload, location, description) value ('$mis', '$title', '$type', '$date_on_doc', '$date_of_upload', '$filename','$description')";
		$result = mysqli_query($con,$sql);	

		if($result){
			$success .= "Saved as draft successfully";
			$status = "<h3 class='bg-success' align='center'> ".$success." </h3>";					
		}
		else{
			$status = "<h3 class='bg-danger' align='center'> Something went wrong.... </h3>";							
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faculty Homepage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.navbar {
			margin-bottom: 0;
			border-radius: 0;
		}

		.row.content {height: 450px}

		.sidenav {
			padding-top: 20px;
			background-color: #f1f1f1;
			height: 100%;
		}

	</style>
</head>
<body>


<div class="container" align="center" height="100px">
	<h1>Patram</h1>      
</div>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="showUploads.php">My Uploads</a></li>
				<li><a href="showDrafts.php">Drafts</a></li>
				<li><a href="update_pers1.php">Update Personal info</a></li>
				<li><a href="showMessages.php">Admin Messages&#160;<span class="badge"><?php echo $count; ?></span></a></li>
				<li><a href="changePassword.php">Change Password</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>You are logged in as <i><b>Faculty</b></i></a></li>
				<li><a href="flogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
  
<div class="container-fluid">    
	<div class="col-lg-2 well">
	</div>
	
	<div class="col-lg-8 well">
	    <h1 align="center" class="well">Upload New Documents</h1>
		<div class="row">
				<form action="facultyH.php" method="post" enctype="multipart/form-data">
				<div class="col-sm-12">
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
									<label for="title">Title</label>    
									<input type="text" name="title" id="title">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
					
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<label for="date">Date :</label>    
								<input type="date" name="date" id="date">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
					
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<input type="radio" name="type" value="paper" id="paper" checked="checked">
								<label for="paper"> paper</label><br>
								<input type="radio" name="type" value="conference" id="conference" >
								<label for="conference"> conference</label><br>
								<input type="radio" name="type" value="visit" id="visit" >
								<label for="visit"> visit</label>
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
					
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<label for="description">Description :</label>   
								<input type="text" name="description" id="description">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
				
					<div class="row">
							<div class="col-sm-4 form-group">
							</div>
							<div class="col-sm-4 form-group">
								<label for="fileToUpload">Select file to upload :</label>   
								<input type="file" name="fileToUpload" id="fileToUpload">
							</div>
							<div class="col-sm-4 form-group">
							</div>
					</div>
		     
					<div class="row">
							<div class="col-sm-4 form-group">
								<label> &#160; </label>
							</div>
							<div class="col-sm-2 form-group">
									<input type="submit" value="Upload" name="upload" style="float: left" class="btn btn-lg btn-info">					
							</div>
							<div class="col-sm-2 form-group">
									<input type="submit" value="Save As Draft" name="draft" style="float: left" class="btn btn-lg btn-info">					
							</div>
							<div class="col-sm-4 form-group">
								<label> &#160; </label>
							</div>
					</div>	
					<div class="row">
							<?php echo $status; ?>					
					</div>
				</div>
				</form>
		</div>
	</div>

	<div class="col-lg-2 well">
	</div>


</div>

</body>
</html>

