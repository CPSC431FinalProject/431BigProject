<?php
session_start();
$currentUser = $_SESSION['currentUser'];
include_once "mysql.connect.php";
$_SESSION['USER_ACTIVITY'] = time();


if (!isset($_SESSION['USER_ACTIVITY'])) {
    // initiate value
    $_SESSION['USER_ACTIVITY'] = time();
}
if (time() - $_SESSION['USER_ACTIVITY'] > 3600) {
    // last activity is more than 10 minutes ago
   //grab the current user, so that we can remove from active users, and hence update the active users
	$currentUser = $_SESSION['currentUser'];
  include_once"logout.php";
} else {
    // update last activity timestamp
    $_SESSION['USER_ACTIVITY'] = time();
}

//query the database to pull all users that are currently logged in.
//if the user has been inactive for more than 10 minutes, it will delete them from the table, and hence log them out.
//the log out will occur because if there is no acive session variable, they will automatically be redirected to login page.

//seelct all users from table
$sql = "SELECT * FROM activeUsers";
//run the query
$result = mysqli_query($con,$sql); 

while(@$row = mysqli_fetch_array($result)) :
	$userLastStamp = $row['dateTime'];
	$user = $row['userName'];
	//check to see if the user has been active in the past 10 minutes
	//if not active in past 10 minutes, then delete from table
	if (time() - $userLastStamp > 600) {
		$sql = "DELETE FROM `activeUsers` WHERE `userName`= '$user'";
		$result = mysqli_query($con,$sql);
	} 
endwhile;
//get current time
//update the timestamp for current user only
$time = time();
$sql="UPDATE activeUsers  SET dateTime='$time' WHERE `userName`='$currentUser'";
if(!mysqli_query($con,$sql))
	{
		die('Error: ' . mysqli_error($con));
	}	
									
?>