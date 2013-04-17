<?php
session_start();
$id = $_POST['delete_id'];
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
  $sql = "DELETE FROM `mailbox` WHERE `id`= '$id'";
  $result = mysqli_query($con,$sql);
  header('Location: messages.php');
?>