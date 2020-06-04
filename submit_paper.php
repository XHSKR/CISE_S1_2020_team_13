<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit a paper</title>
</head>

<body>
<h1>Submit a paper</h1>

<?php
include 'login_check.php';
?>

<h3>Please fill in every forms to submit a paper.</h3></label>
<p> <label>Author: </label></p>
<p><input type="text" name="author" id="author" /></p>
<p> <label>Title: </label></p>
<p><input type="text" name="title" id="title" size="30" /></p>
<p> <label>Publish Year: </label></p>
<p><input type="number" name="year" id="year" style="width: 5em" /></p>
<p><label>Description:</label></p>
<p><textarea id="description" name="description" rows="4" cols="50"></textarea></p>
<p> <input type="submit" name="submit" value="Submit" /></p>

<p><a href='/'>Back to Main Page</a></p>
</body>
</html>
