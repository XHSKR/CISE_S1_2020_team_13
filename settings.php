<?php 
$host = "us-cdbr-east-06.cleardb.net"; 
$user = "b1762cb1b9db93"; // your user name
$pswd = "80c477e6"; // your password
$dbnm = "heroku_7b280883e75b2b2"; // your database

// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = mysqli_connect($host,
		$user,
		$pswd,
		$dbnm
	);
?>