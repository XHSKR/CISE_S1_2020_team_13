<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Application Management</title>
</head>

<body>
<h1>Account Application Management</h1>

<?php
include 'login_check.php';
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
if ($usertype != 'admin') //if not admin
{
    echo "<meta http-equiv='refresh' content='0;url=/'>";
    exit;
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
    if (!$result) {
        echo "The table does not exist.";
        return;
    }
    $query = "SELECT * FROM SEER WHERE isAllowed LIKE 'No'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        echo "<table border=\"1\">";
        echo "<tr>\n"
            . "<th scope=\"col\">userid</th>\n"
            . "<th scope=\"col\">username</th>\n"
            . "<th scope=\"col\">password (Encrypted)</th>\n"
            . "<th scope=\"col\">email</th>\n"
            . "<th scope=\"col\">usertype</th>\n"
            . "<th scope=\"col\"><b>Allow</b></th>\n"
            . "<th scope=\"col\"><b>Reject</b></th>\n"
            . "</tr>\n";

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $allow_button = '<form method="POST" style="margin: 0px;">
                <input type="hidden" name="userid_accept" value="' . $row["userid"] . '">
                <input type="submit" value="Allow">
                </form>
                ';
            $reject_button = '<form method="POST" style="margin: 0px;">
                <input type="hidden" name="userid_reject" value="' . $row["userid"] . '">
                <input type="submit" value="Reject">
                </form>
                ';

            echo "<tr>";
            echo "<td>", $row["userid"], "</td>";
            echo "<td>", $row["username"], "</td>";
            echo "<td>", $row["pwd"], "</td>";
            echo "<td>", $row["email"], "</td>";
            echo "<td>", $row["usertype"], "</td>";
            echo '<td>', $allow_button, "</td>";
            echo '<td>', $reject_button, "</td>";
            echo "</tr>";

        }
        if (isset($_POST['userid_accept'])) { //if allow button is clicked
            $userid = $_POST['userid_accept'];
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

                    $query = "UPDATE SEER SET isAllowed = 'Yes' WHERE userid = " . $userid . ";";
                    $result = mysqli_query($conn, $query);
                    // checks if the execution was successful
                    if (!$result) {
                        echo "<p>Something is wrong with ", $query, "</p>";
                    } else {
                        // display an operation successful message
                        echo "
                        <script>
                        window.location.href = window.location.href
                        </script>
                        ";
                    }
                }
            }
        }

        if (isset($_POST['userid_reject'])) { //if reject button is clicked
            $userid = $_POST['userid_reject'];
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
                    $query = "UPDATE SEER SET isAllowed = 'Rejected' WHERE userid = " . $userid . ";";
                    $result = mysqli_query($conn, $query);
                    // checks if the execution was successful
                    if (!$result) {
                        echo "<p>Something is wrong with ", $query, "</p>";
                    } else {
                        // display an operation successful message
                        echo "
                        <script>
                        window.location.href = window.location.href
                        </script>
                        ";
                    }
                }
            }
        }
    } else {
        echo "No application to show.";
    }

}
echo "<p><a href='/'>Back to Main Page</a></p>";
?>
</body>
</html>