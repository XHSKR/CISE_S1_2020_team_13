<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SEER Main</title>
</head>

<body>

<?php
include 'login_check.php';
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
echo "<h1>Hello, $username ($usertype) !</p></h1>";
?>

<form method="get">
	<fieldset>
		<legend>Search Articles</legend>
		<p> <label for="datefrom">Date Range from</label>
			<input type="date" name="datefrom" value="<?php echo date('yy-m-d') ?>" />
			<label for="dateto"> to </label>
			<input type="date" name="dateto" value="<?php echo date('yy-m-d') ?>" /></p>
		<p> <label for="datefrom">User Rating from</label>
			<select name="userratingfrom" style="margin-right: 5px">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<label for="datefrom">to</label>
			<select name="userratingto" style="margin-right: 5px">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select></p>
		<p><select name="searchby" style="margin-right: 5px">
				<option value="article">Article</option>
				<option value="author">Author</option>
			</select>

			<input type="text" name="text" placeholder="Enter here">
			<input type="submit" name="submit" value="Search" />
			<input type="reset" value="Clear" name="reset" /></p>

</form>

<?php
if (isset($_GET['submit'])) { //if button is clicked
    // Get data from the form
    $text = $_GET["text"];
    if (empty($text)) {
        echo "Please enter text.";
    } else {
        echo "No search result.";
    }

}
?>
</fieldset>
<p><a href='submit_paper.php'>Submit a paper</a></p>
<p><a href='quality_check.php'>Paper Quality Check for SERL Moderator</a></p>
<p><a href='paper_analysis.php'>Paper Analysis SERL Analyst</a></p>
<p><a href='account_application.php'>Account Application Management</a></p>
<p><a href='logout.php'>Logout</a></p>
</body>
</html>