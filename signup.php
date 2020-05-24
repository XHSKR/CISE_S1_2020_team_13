<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>Sign up Page</title>
</head>

<body>
<h1>Sign up Page</h1>
	<form method="post" action="member_add.php">
		<p>	<label for="username">Username: </label>
			<input type="text" name="username" id="username" /></p>
		<p>	<label for="pwd">Password: </label>
			<input type="password" name="pwd" id="pwd" /></p>
        <p> <label for="pwd2">Password again: </label>
			<input type="password" name="pwd2" id="pwd2" /></p>
		<p>	<label for="email">Enter email: </label>
			<input type="text" name="email" id="email" /></p>
		<p>	<label for="occupation">User Type: </label>
		<select name="usertype">
			<option value="student">Student</option>
			<option value="researcher">Researcher</option>
			<option value="affiliation ">Affiliation</option>
			<option value="host">SERL Host</option>
			<option value="analyst">SERL Analyst</option> </select></p>
        <p>	<input type="submit" value="Sign up" />
		<input type="reset" value="Reset" name="reset" /> <br /><br />
		<a href="index.php">Return to Home Page </a></p>
	</form>
</body>
</html>