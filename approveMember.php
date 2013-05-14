<?php
include('mysql.connect.php');


$username = $_GET['user'];
$club = $_GET['club'];

$sql = "INSERT INTO clubMembers (clubName,userName,clubAdmin)VALUES('$club','$username','0')";
$result = mysqli_query($con,$sql);

if($result)
{
	$return = "<html><body onload=\"alert('Submitted Successfully');\"></body></html>";
}
else
{
	$return = "<html><body onload=\"alert('Failed to add user to club.');\"></body></html>";
}
header('Location:messages.php');