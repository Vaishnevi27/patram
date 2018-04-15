<?php

	include 'connectivity.php';
//	session_start();

	$err = "";
	$mis = "";
	$title = "";
	$type = "";
	$date_on_doc = "";
	$date_of_upload = "";
	
	if(isset($_POST['submit'])){
		$title = $_POST['title'];
		$mis = "111508077";	//get from session
		$type = $_POST['type'];
		$date_of_upload = date('Y-m-d H:i:s');
		$date_on_doc = $_POST['date'];
		
//		echo $date_of_upload;
		echo $date_on_doc;

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
		if($fileType != "image/jpg" && $fileType != "image/png" && $fileType != "image/jpeg" && $fileType != "image/gif" && $fileType != "application/pdf" ) {
			$err .= "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
			$uploadOk = 0;
		}

		if ($uploadOk != 1) {
			$err .= "Sorry, your file was not uploaded.";
		} 
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$err .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$sql = "insert into uploads (mis, title, type, date_on_doc, date_of_upload, location) value ('$mis', '$title', '$type', '$date_on_doc', '$date_of_upload', '$filename')";
				$result = mysqli_query($con,$sql);	
			} 
			else {
				$err .= "Sorry, there was an error uploading your file.";
			}
		}
	}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
	Title:    <input type="text" name="title" id="title">
<br>
	Date:    <input type="date" name="date" id="date">
<br>
	Type: 
<input type="radio" name="type" value="paper">Paper</input>
<input type="radio" name="type" value="conference">Conference</input>
<input type="radio" name="type" value="visit">Visit</input>
<br>
	Description: <input type="text" name="description" id="description">
	
    Select image to upload:     <input type="file" name="fileToUpload" id="fileToUpload">
<br>    
    <input type="submit" value="Upload" name="submit">
<br>
	<span id="error" class="error"><?php echo $err;?></span>

</form>



<div class="container-fluid">
	<div class="col-lg-12 well">
    <h1 align="center" class="well">Upload New Documents</h1>
	<div class="row">
			<form action="facultyH.php" method="post" enctype="multipart/form-data">
			<div class="col-sm-12">
				<div class="row">
						<div class="col-sm-12 form-group">
								<label for="title">Title</label>    
								<input type="text" name="title" id="title">
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-12 form-group">
							<label for="date">Date :</label> <br/>   
							<input type="date" name="date" id="date">
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-4 form-group">
							<input type="radio" name="type" value="paper" id="paper" >
							<label for="paper"> paper</label>
						</div>
						<div class="col-sm-4 form-group">
							<input type="radio" name="type" value="paper" id="paper" >
							<label for="conference"> conference</label>
						</div>
						<div class="col-sm-4 form-group">
							<input type="radio" name="type" value="paper" id="paper" >
							<label for="visit"> visit</label>
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-12 form-group">
							<label for="description">Description :</label> <br/>   
							<input type="text" name="description" id="description">
						</div>
				</div>
				<hr>
				<div class="row">
						<div class="col-sm-12 form-group">
							<label for="fileToUpload">Select image to upload :</label> <br/>   
							<input type="file" name="fileToUpload" id="fileToUpload">
						</div>
				</div>
				<hr>
         
				<div class="row">
						<div class="col-sm-1 form-group">
							<label> &#160; </label>
						</div>
						<div class="col-sm-5 form-group">
							    <input type="submit" value="Upload" name="submit" style="float: left" class="btn btn-lg btn-info">					
						</div>
						<div class="col-sm-2 form-group">
							<label> &#160; </label>
						</div>
				</div>						
			</div>
			</form>
	</div>
	</div>

</div>
</body>
</html>


