<?php
// Get data from the form
$statuscode = $_POST["statuscode"];
$status = $_POST["status"];
$share = $_POST["share"];
$date = $_POST["date"];
$allowlike = $_POST["allowlike"];
$allowcomment = $_POST["allowcomment"];
$allowshare = $_POST["allowshare"];

//if checkbox is not checked save it as No
if (empty($allowlike))
$allowlike = 'No';
if (empty($allowcomment))
$allowcomment = 'No';
if (empty($allowshare))
$allowshare = 'No';

//check if all required data is retrieved
if (empty($statuscode) || empty($status) || empty($date))
{ 
	echo "<h1>Error</h1>
	Please fill in every required forms.
	<p><a href='poststatusform.php'>Return to Post Status Page </a></p>
	<p><a href='index.html'>Go to the Home Page </a></p>
	";
	return;
}
require_once ("../../conf/settings.php"); //get mysql credentials
// Checks if connection is successful
if (!$conn)
{
    // Displays an error message
    echo "<p>Database connection failure</p>";
	echo "<p><a href='index.html'>Return to Home Page </a></p>";
	return;
}
else
{
    // Upon successful connection
    $query = "SELECT * FROM status";
    $result = mysqli_query($conn, $query);
    //check if table exists
    if (!$result)
    { //if table does not exist, create table
        $query = "CREATE TABLE status (
                          status_id int(11) AUTO_INCREMENT,
                          statuscode varchar(40) NOT NULL,
						  status varchar(40) NOT NULL,
						  share varchar(40) NOT NULL,
						  date date NOT NULL,
						  allowlike varchar(40) NOT NULL,
						  allowcomment varchar(40) NOT NULL,
						  allowshare varchar(40) NOT NULL,
                          PRIMARY KEY  (status_id)
                          )";
        $result = mysqli_query($conn, $query);
    }
	//check if statuscode is unique in database
$query = "SELECT * FROM status WHERE statuscode LIKE '" . $statuscode . "'";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0)
	{
	//notify user and go back to previous page
	echo "<h1>Error</h1>
	The statuscode you typed already exists in the database.
	<p><a href='poststatusform.php'>Return to Post Status Page </a></p>
	<p><a href='index.html'>Go to the Home Page </a></p>
	";
	return;
	}
	// Set up the SQL command to add the data into the table
	// For assessor only: Sql Server does not store data(Including DATE) in the yyyy-MM-dd format at all. It stores dates in a binary format that's not human readable, and only converts them to the format. I will convert it into dd/mm/yyyy format when searching.
		$query = "insert into status"
						."(statuscode, status, share, date, allowlike, allowcomment, allowshare)"
					. "values"
						."('$statuscode','$status','$share', '$date', '$allowlike', '$allowcomment', '$allowshare')";
		// executes the query
		$result = mysqli_query($conn, $query);
		// checks if the execution was successful
		if(!$result) {
			echo "<p>Something is wrong with ",	$query, "</p>";
		} else {
			mysqli_free_result($result);
			// display an operation successful message
			echo "<h1>Success</h1>
			The status has been saved successfully in the database.
			<p><a href='index.html'>Go to the Home Page </a></p>
			";
		} 
}
?>
