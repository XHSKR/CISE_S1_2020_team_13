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
	<fieldset style="width:500px">
		<legend>Search Articles</legend>
		<p> <label for="datefrom">Date Range &nbsp;</label>
		<input type="number" name="datefrom" min="1900" max="2099" value="2020" />
			<label for="dateto">&nbsp; ~ &nbsp;</label>
			<input type="number" name="dateto" min="1900" max="2099" value="2020" /></p>
		<p> <label for="datefrom">User Rating &nbsp;</label>
			<select name="userratingfrom" style="margin-right: 5px">
				<option value="1">★</option>
				<option value="2">★★</option>
				<option value="3">★★★</option>
				<option value="4">★★★★</option>
				<option value="5">★★★★★</option>
			</select>
			<label for="datefrom">&nbsp; ~ &nbsp;</label>
			<select name="userratingto" style="margin-right: 5px">
				<option value="1">★</option>
				<option value="2">★★</option>
				<option value="3">★★★</option>
				<option value="4">★★★★</option>
				<option value="5">★★★★★</option>
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
        echo "No results found matching your criteria.";
    }

}
?>
</fieldset>
<p><a href='submit_paper.php'>Submit a paper</a></p>
<p><a href='quality_check.php'>Paper Quality Check for SERL Moderator</a></p>
<p><a href='paper_analysis.php'>Paper Analysis for SERL Analyst</a></p>
<p><a href='application_management.php'>Account Application Management</a></p>
<p><a href='account_management.php'>Account Management</a></p>
<p><a href='logout.php'>Logout</a></p>
</body>
</html>