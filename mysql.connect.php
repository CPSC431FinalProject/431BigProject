<?php
//$con = @mysqli_connect("ecsmysql", "cs431s24", "meifithi", "cs431s24");
$con = mysqli_connect('localhost','kascheri','mysql','BigProject');
if(!$con){ echo mysqli_connect_errno(); }
?>
