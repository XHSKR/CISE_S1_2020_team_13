<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log in Page</title>
</head>

<body>
<h1>Log in Page</h1>
	<form method="post">
		<p>	<label for="username">Username: </label>
			<input type="text" name="username" id="username" /></p>
		<p>	<label for="pwd">Password: </label>
			<input type="password" name="pwd" id="pwd" /></p>
		<p>	<input type="submit" name="submit" value="Log in" /></p>
	</form>

<?php
session_start();
if (isset($_SESSION['username']) || isset($_SESSION['usertype'])) {
    echo "<meta http-equiv='refresh' content='0;url=/'>";
    exit;
}
if (isset($_POST['submit'])) { //if button is clicked
    // Get data from the form
    $username = $_POST["username"];
    $pwd = md5($_POST["pwd"]);
    if (empty($username) || empty($pwd)) {
        echo "
	<script>
	alert('Please enter username and password.');
	history.back();
	</script>
	";
        return;
    }
    require_once "settings.php";
// Checks if connection is successful
    if (!$conn) {
        // Displays an error message
        echo "<b>Database connection failure</b>";
    } else {
        // Upon successful connection
        $query = "SELECT * FROM SEER";
        $result = mysqli_query($conn, $query);
        //check if table exists
        if (!$result) { //if table does not exist
            echo "<b>Table does not exist.</b>";
        } else {
//check if username exists in database
            $query = "SELECT * FROM SEER WHERE username LIKE '" . $username . "'";
            $result = mysqli_query($conn, $query);
            if ($result->num_rows > 0) //if user exists
            {
                $query = "SELECT * FROM SEER WHERE username = '" . $username . "' AND pwd = '" . $pwd . "'";
                $result = mysqli_query($conn, $query);

                if ($result->num_rows > 0) //if username and pwd match
                {
                    //check if the account is allowed
                    $query = "SELECT * FROM SEER WHERE username LIKE '" . $username . "'";
                    $result = mysqli_query($conn, $query);
                    $row = $result->fetch_assoc();
                    $isAllowed = $row["isAllowed"];
                    if ($isAllowed == "Yes") {
                        $usertype = $row["usertype"];
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['usertype'] = $usertype;
                        echo "<meta http-equiv='refresh' content='0;url=/'>";
                    } else if ($isAllowed == "No") {
                        echo "Your account application is still in process for review. Please try again later.";
                    } else if ($isAllowed == "Rejected") {
                        echo "Sorry, but your application has been rejected.";
                    }

                } else {
                    echo "Incorrect password.";
                }

            } else {
                echo "Username does not exist.";
            }
        }
    }

}
?>
<p><a href="signup.php">Don't have an account? </a></p>
</body>
</html>