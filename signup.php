<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>Sign up Page</title>
</head>

<body>
<h1>Sign up Page</h1>
	<form method="post">
		<p>	<label for="username">Username: </label>
			<input type="text" name="username" id="username" /></p>
		<p>	<label for="pwd">Password: </label>
			<input type="password" name="pwd" id="pwd" /></p>
        <p> <label for="pwd2">Password again: </label>
			<input type="password" name="pwd2" id="pwd2" /></p>
		<p>	<label for="email">Enter email: </label>
			<input type="text" name="email" id="email" /></p>
		<p>	<label for="usertype">User Type: </label>
		<select name="usertype">
			<option value="student">Student</option>
			<option value="researcher">Researcher</option>
			<option value="affiliation ">Affiliation</option>
			<option value="host">SERL Host</option>
			<option value="analyst">SERL Analyst</option> </select></p>
        <p>	<input type="submit" name="submit" value="Sign up" />
		<input type="reset" value="Reset" name="reset" /></p>
	</form>
</body>
</html>

<?php
if(isset($_POST['submit'])){ //if button is clicked
// Get data from the form
$username = $_POST["username"];
$pwd = $_POST["pwd"];
$pwd2 = $_POST["pwd2"];
$email = $_POST["email"];
$usertype = $_POST["usertype"];

//check if all required data is retrieved
if (empty($username) || empty($pwd) || empty($pwd2) || empty($email) ||empty($usertype))
{ 
	echo "
	<script>
	alert('Please fill in every required forms.');
	history.back();
	</script>
	";
	return;
}
if ($pwd != $pwd2)
{
	echo "
	<script>
	alert('Password is not matching.');
	history.back();
	</script>
	";
	return;
}
require_once ("settings.php");
// Checks if connection is successful
	if (!$conn) {
		// Displays an error message
		echo "<b>Database connection failure</b>";
	} else {
		// Upon successful connection
		$query = "SELECT * FROM SEER";
		$result = mysqli_query($conn, $query);
		//check if table exists
		if (!$result)
		{ //if table does not exist, create table
		$query = "CREATE TABLE SEER (
		userid int(11) AUTO_INCREMENT,
		username varchar(40) NOT NULL,
		pwd varchar(40) NOT NULL,
		email varchar(40) NOT NULL,
		usertype varchar(40) NOT NULL,
		isAllowed varchar(40) NOT NULL,
		PRIMARY KEY  (userid)
		)";
		$result = mysqli_query($conn, $query);
		}
		//check if username is unique in database
$query = "SELECT * FROM SEER WHERE username LIKE '" . $username . "'";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0)
	{
	//notify user and go back to previous page
	echo "
	<script>
	alert('The username already exists.');
	history.back();
	</script>
	";
	return;
	}
// Set up the SQL command to add the data into the table
$query = "insert into seer"
."(username, pwd, email, usertype, isAllowed)"
. "values"
."('$username','$pwd','$email', '$usertype', 'No')";
		// executes the query
		$result = mysqli_query($conn, $query);
		// checks if the execution was successful
		if(!$result) {
			echo "<p>Something is wrong with ",	$query, "</p>";
		} else {
			// display an operation successful message
			echo "The request has been sent !";
		} 
	}
}
?>
<p><a href="index.php">Return to Home Page </a></p>
</body> 
</html>