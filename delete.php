<?php
session_start();
$id = $_POST['delete_id'];
include_once "mysql.connect.php";
  $sql = "DELETE FROM mailbox WHERE id = '$id'";
  $result = mysqli_query($con,$sql);
  if($result) :
  	header('Location: messages.php');
  endif;
?>