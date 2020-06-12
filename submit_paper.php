<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit a paper</title>
</head>

<body>
<h1>Submit a paper</h1>

<?php
include 'login_check.php';
$username = $_SESSION['username'];
?>

<h3>Please fill in every forms to submit a paper.</h3></label>
<form method="post">
<p> <label>Author: </label></p>
<p><input type="text" name="author" id="author" placeholder = "Aniche"/></p>
<p> <label>Title: </label></p>
<p><input type="text" name="title" id="title" size="52" placeholder = "Most common mistakes in test-driven development practice" /></p>
<p> <label>Publish Year: </label></p>
<p><input type="number" name="year" id="year" min="1900" max="2099" placeholder = "2010" style="width: 5em"/></p>
<p><label>Description:</label></p>
<p><textarea id="description" name="description" rows="4" cols="50"></textarea></p>
<p> <input type="submit" name="submit" value="Submit" /></p>
</form>
<?php
if (isset($_POST['submit'])) { //if button is clicked
    // Get data from the form
    $author = $_POST["author"];
    $title = $_POST["title"];
    $year = $_POST["year"];
    $description = $_POST["description"];

    //check if all required data is retrieved
    if (empty($author) || empty($title) || empty($year) || empty($description)) {
        echo "
            <script>
            alert('Please fill in every required forms.');
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
        $query = "SELECT * FROM paper";
        $result = mysqli_query($conn, $query);
        //check if table exists
        if (!$result) { //if table does not exist
            echo "<b>Table does not exist.</b>";
        } else {
            //get today date
            $date = date('yy-m-d');
            // Set up the SQL command to add the data into the table
            $query = "insert into paper"
                . "(submitter, author, title, year, description, submitted_date, status)"
                . "values"
                . "('$username','$author','$title','$year', '$description', '$date', 'pending')";
            // executes the query
            $result = mysqli_query($conn, $query);
            // checks if the execution was successful
            if (!$result) {
                echo "<p>Something is wrong with ", $query, "</p>";
            } else {
                // display an operation successful message
                echo "
                <script>
                alert('Successfully submitted !');
                </script>
                ";
                echo "<meta http-equiv='refresh' content='0;url=/'>";
            }
        }
    }
}
?>
<p><a href='/'>Back to Main Page</a></p>
</body>
</html>
