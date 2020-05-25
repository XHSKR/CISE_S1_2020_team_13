<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log in Page</title>
</head>

<body>
<h1>Main Page</h1>
<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['usertype'])){
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
echo "<!DOCTYPE html>";
echo "<meta charset='utf-8' />";
echo "<p>Hello, $username ($usertype) !</p>";
echo "<p><a href='account_application.php'>Account Application Management</a></p>";
echo "<p><a href='logout.php'>Logout</a></p>";
?>
</body>
</html>