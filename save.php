<?php
$currentUser = $_SESSION['currentUser'];
if (!empty($_POST['text'])) {

$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//mysql_select_db("chat", $con);

$chatItem=$_POST['text'];
	$sql = "INSERT INTO message (message, sender) 
			VALUES 
			('$chatItem', $currentUser)";
	if(!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
}

?>