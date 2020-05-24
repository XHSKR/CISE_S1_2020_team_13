<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with PHP</title>
</head>

<body>
<h1>Add Data Form</h1>
	<form method="post" action="member_add.php">
		<p>	<label for="fname">Enter first name: </label>
			<input type="text" name="fname" id="fname" /></p>
		<p>	<label for="lname">Enter last name: </label>
			<input type="text" name="lname" id="lname" /></p>
		<p>	<label for="gender">Select gender: </label>
		<select name="gender">
			<option value="m">Male</option>
			<option value="f">Female</option> </select></p>
		<p>	<label for="email">Enter email: </label>
			<input type="text" name="email" id="email" /></p>
		<p> <label for="phone">Enter phone number: </label>
			<input type="text" name="phone" id="phone" /></p>
        <p>	<input type="submit" value="Add Item" /></p>
	</form>
</body>
</html>