<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Main Page</title>
</head>

<body>

<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
echo "<!DOCTYPE html>";
echo "<meta charset='utf-8' />";
echo "<h1>Hello, $username ($usertype) !</p></h1>";
?>

<form method="get">
<p>	<label for="datefrom">Date Range from</label>
			<input type="date" name="datefrom" value="<?php echo date('yy-m-d') ?>" />
	<label for="dateto"> to </label>
			<input type="date" name="dateto" value="<?php echo date('yy-m-d') ?>" /></p>
<p>	<label for="datefrom">User Rating from</label>
			<select name="userratingfrom" style="margin-right: 5px">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option> </select>
<label for="datefrom">to</label>
<select name="userratingto" style="margin-right: 5px">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option> </select></p>
<p><select name="searchby" style="margin-right: 5px">
	<option value="article">Article</option>
	<option value="author">Author</option> </select>

<input type="text" name="text" placeholder="Enter here">
	<input type="submit" name="submit" value="Search"/>
	<input type="reset" value="Clear" name="reset" /></p>
</form>
<?php
if (isset($_GET['submit'])) { //if button is clicked
    echo "No search result.";
}
?>
<p><a href='account_application.php'>Account Application Management</a></p>
<p><a href='logout.php'>Logout</a></p>
</body>
</html>