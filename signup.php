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
		<input type="reset" value="Reset" name="reset" /> <br /><br />
		<a href="index.php">Return to Home Page </a></p>
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

echo $username;
echo "test";
}
?>