<?php	
	//Connect to database[server,usernsme,password,database]
	$con = mysqli_connect("localhost","root","Nikita@8077","ddms") ;
	if (mysqli_connect_errno())
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>
