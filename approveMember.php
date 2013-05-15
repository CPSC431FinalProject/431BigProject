<?php
include('mysql.connect.php');


$username = $_GET['user'];
$club = $_GET['club'];

$sql = "INSERT INTO clubMembers (clubName,userName,clubAdmin)VALUES('$club','$username','0')";
$result = mysqli_query($con,$sql);

if($result)
{
	//send an email to club member informing them they have been approved
	$subject = "Welcome to our club!";
	$msgText = "Hi $username,<br /><br />I just wanted to stop by and welcome you to our club. " .
		"You can check out the forum area for our club at the link below. Come say hi! " .
		"Sincerely,<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspClub Admin" .
		"<br /><br /><div class=navigation clearfix><a href=forum.php?id=$club>$club forum</a></div><br /><br />";
	$sender = "SYSTEM";
	$receiver = $username;
	
	//store the message in the mailbox
	$tblName2 = "mailbox";
	
	$today = date("F j, Y, g:i a"); 
	
	//so that "from" field won't be empty, we should make it be from "SYSTEM"
	$sql2 = "INSERT INTO $tblName2 (subject,msgText,sender,receiver,status,dateTime)
		VALUES
		('$subject','$msgText','$sender','$receiver','New','$today')";
	$result2 = @mysqli_query($con, $sql2);
	//if message was sent (successfully inserted into db) refresh page to inbox
	if($result2)
		header('Location:messages.php');
}
else
{
	$return = "<html><body onload=\"alert('Failed to add user to club.');\"></body></html>";
}
print($return);

?>