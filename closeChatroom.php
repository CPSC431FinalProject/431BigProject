<?php
session_start();

//connection to database
include('mysql.connect.php');

//get chatroom id that was posted
$id = $_POST['id'];

//query database to delete chatroom given id
$sql = "DELETE FROM chatroom WHERE CRNo = '$id'";
$result = mysqli_query($con,$sql);
$sql2 = "DELETE FROM message WHERE CRNo = '$id'";
$result2 = mysqli_query($con,$sql2);

header("Location:chat.php");

?>