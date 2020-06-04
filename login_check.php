<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) { //if userdata not retrieved
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}
