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
    echo "
        <script>
        alert('You are not authorised to view this webpage.');
        history.back();
        </script>
        ";
    exit;
}

require_once "settings.php";
// Checks if connection is successful
if (!$conn) {
    // Displays an error message
    echo "<b>Database connection failure</b>";
} else {
    // Upon successful connection
    $query = "SELECT * FROM accounts";
    $result = mysqli_query($conn, $query);
    //check if table exists
    if (!$result) {
        echo "The table does not exist.";
        return;
    }
    $query = "SELECT * FROM accounts WHERE status LIKE 'pending'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        echo "<table border=\"1\">";
        echo "<tr>\n"
            . "<th scope=\"col\">Creation Date</th>\n"
            . "<th scope=\"col\">Username</th>\n"
            . "<th scope=\"col\">Email Address</th>\n"
            . "<th scope=\"col\">UserType</th>\n"
            . "<th scope=\"col\"><b>Approve</b></th>\n"
            . "<th scope=\"col\"><b>Reject</b></th>\n"
            . "</tr>\n";

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $approve_button = '<form method="POST" style="margin: 0px;">
                            <input type="hidden" name="userid_approve" value="' . $row["userid"] . '">
                            <input type="submit" value="Approve">
                            </form>
                            ';
            $reject_button = '<form method="POST" style="margin: 0px;">
                            <input type="hidden" name="userid_reject" value="' . $row["userid"] . '">
                            <input type="submit" value="Reject">
                            </form>
                            ';

            echo "<tr>";
            $converted_date = date('d/m/Y', strtotime($row["creation_date"]));
            echo "<td>", $converted_date, "</td>";
            echo "<td>", $row["username"], "</td>";
            echo "<td>", $row["email"], "</td>";
            echo "<td>", $row["usertype"], "</td>";
            echo '<td>', $approve_button, "</td>";
            echo '<td>', $reject_button, "</td>";
            echo "</tr>";

        }

    } else {
        echo "No applications to show.";
    }

    if (isset($_POST['userid_approve']) || isset($_POST['userid_reject'])) { //if button is clicked

        if (isset($_POST['userid_approve'])) {
            $userid = $_POST['userid_approve'];
            $status = "approved";
        }

        if (isset($_POST['userid_reject'])) {
            $userid = $_POST['userid_reject'];
            $status = "rejected";
        }

        require_once "settings.php";
        // Checks if connection is successful
        if (!$conn) {
            // Displays an error message
            echo "<b>Database connection failure</b>";
        } else {
            // Upon successful connection
            $query = "SELECT * FROM accounts";
            $result = mysqli_query($conn, $query);
            //check if table exists
            if (!$result) { //if table does not exist
                echo "<b>Table does not exist.</b>";
            } else {

                $query = "UPDATE accounts SET status = '$status' WHERE userid = " . $userid . ";";
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
}
?>
<p><a href='/'>Back to Main Page</a></p>
</body>
</html>