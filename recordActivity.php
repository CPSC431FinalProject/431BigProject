<?php
session_start();
$currentUser = $_SESSION['currentUser'];
$_SESSION['USER_ACTIVITY'] = time();


if (!isset($_SESSION['USER_ACTIVITY'])) {
    // initiate value
    $_SESSION['USER_ACTIVITY'] = time();
}
if (time() - $_SESSION['USER_ACTIVITY'] > 3600) {
    // last activity is more than 10 minutes ago
   //grab the current user, so that we can remove from active users, and hence update the active users
	$currentUser = $_SESSION['currentUser'];
	$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
    $sql = "DELETE FROM `activeUsers` WHERE `userName`= '$currentUser'";
	$result = mysqli_query($con,$sql);
} else {
    // update last activity timestamp
    $_SESSION['USER_ACTIVITY'] = time();
}
													
?>