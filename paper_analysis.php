<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paper Analysis for SERL Analyst</title>
</head>

<body>
<h1>Paper Analysis for SERL Analyst</h1>

<?php
include 'login_check.php';
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
if ($usertype != 'analyst' && $usertype != 'admin') //if not analyst nor admin
{
    echo "
        <script>
        alert('You are not authorised to view this webpage.');
        history.back();
        </script>
        ";
    exit;
}
?>

No papers to show.


<p><a href='/'>Back to Main Page</a></p>
</body>
</html>
