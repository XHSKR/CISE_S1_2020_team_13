<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Application Management</title>
</head>

<body>
<h1>Account Application Management</h1>
<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['usertype'])){ //if userdata not retrieved
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
if($usertype != 'admin') //if not admin
{
    echo "<meta http-equiv='refresh' content='0;url=/'>";
	exit;
}

require_once ("settings.php");
// Checks if connection is successful
if (!$conn)
{
    // Displays an error message
		echo "<b>Database connection failure</b>";
}
else
{
	// Upon successful connection
    $query = "SELECT * FROM SEER";
    $result = mysqli_query($conn, $query);
    //check if table exists
	if (!$result)
    {
		echo "The table does not exist.";
		return;
	}
$query = "SELECT * FROM SEER WHERE isAllowed LIKE 'No'";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
	echo "<table border=\"1\">";
			echo "<tr>\n"
				 ."<th scope=\"col\">userid</th>\n"
			     ."<th scope=\"col\">username</th>\n"
				 ."<th scope=\"col\">pwd</th>\n"
				 ."<th scope=\"col\">email</th>\n"
				 ."<th scope=\"col\">usertype</th>\n"
				 ."<th scope=\"col\"><b>Allow</b></th>\n"
				 ."</tr>\n";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $allow_button = '
                <form method="POST">
                <input type="hidden" name="userid" value="' . $row["userid"] . '">
                <input type="submit" value="Allow">
                </form>
                ';
        echo '<form method="post">';
			echo "<tr>";
				echo "<td>",$row["userid"],"</td>";
				echo "<td>",$row["username"],"</td>";
				echo "<td>",md5($row["pwd"]),"</td>";
				echo "<td>",$row["email"],"</td>";
                echo "<td>",$row["usertype"],"</td>";
				echo "<td>",$allow_button,"</td>";
				echo "</tr>";
        }
        echo "</form>";
        if(isset($_POST['userid'])){ //if button is clicked
            $userid = $_POST['userid'];
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
                    { //if table does not exist
                        echo "<b>Table does not exist.</b>";
                    }
                    else
                    {

                    $query = "UPDATE SEER SET isAllowed = 'Yes' WHERE userid = " . $userid . ";";
                    $result = mysqli_query($conn, $query);
                    // checks if the execution was successful
                    if(!$result) {
                        echo "<p>Something is wrong with ",	$query, "</p>";
                    } else {
                        // display an operation successful message
                        echo "
                    <script>
                    location.reload();
                    </script>
                    ";
                    
                    } 
                    }
                }
        }
}
else 
{
    echo "No application to show.";
}

}
?>
</body> 
</html>