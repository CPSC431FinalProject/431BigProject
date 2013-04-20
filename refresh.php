<?php
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//mysql_select_db("chat", $con);
$sql = "SELECT * FROM message ORDER BY id DESC LIMIT 5";
$result = mysqli_query($con, $sql);


while($row = mysqli_fetch_array($result))
  {
  echo '<p>'.'<span>'.$row['sender'].'</span>'. '&nbsp;&nbsp;' . $row['message'].'</p>';
  }

?>
