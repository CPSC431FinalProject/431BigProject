<?php
session_start();
//grab the current user, so that we can remove from active users, and hence update the active users
$currentUser = $_SESSION['currentUser'];
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
  $sql = "DELETE FROM `activeUsers` WHERE `userName`= '$currentUser'";
  $result = mysqli_query($con,$sql);
session_unset();
session_destroy();
header('Location: index.php');
?>