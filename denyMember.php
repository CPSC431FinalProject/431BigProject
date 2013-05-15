<?php
include('mysql.connect.php');


$username = $_GET['user'];
$club = $_GET['club'];

//send an email to club member informing them they have been denied
$subject = "You are not welcome here";
$msgText = "Hi $username,<br /><br />You have been denied membership to our club. " . 
	"If you'd like to join the club at a later time, you may apply again. <br /><br />" . 
	"Sincerely,<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspClub Admin";
$sender = "SYSTEM";
$receiver = $username;

//store the message in the mailbox
$tblName2 = "mailbox";

$today = date("F j, Y, g:i a"); 

$sql2 = "INSERT INTO $tblName2 (subject,msgText,sender,receiver,status,dateTime)
	VALUES
	('$subject','$msgText','$sender','$receiver','New','$today')";
$result2 = @mysqli_query($con, $sql2);

//if message was sent (successfully inserted into db) refresh page to inbox
if($result2)
{
	header('Location:messages.php');
}
?>