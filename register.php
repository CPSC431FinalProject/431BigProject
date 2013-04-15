<?php
session_start();
if(!empty($_POST['realName']) && !empty($_POST['usernamesignup']) && !empty($_POST['passwordsignup']) && !empty ($_POST['passwordsignup_confirm'])){
								$passWord = $_POST['passwordsignup'];
								$passWord2 = $_POST['passwordsignup_confirm'];
								if($passWord != $passWord2)
									{
										echo "Please Input a matching password";
									}
								else{
									$passWord = md5($passWord);
									$sql="INSERT INTO users (UserFullName, usernamesignup, password)
										VALUES
										('$_POST[realName]','$_POST[usernamesignup]','$passWord')";
										header('Location: index.php');
									if(!mysqli_query($con,$sql))
									{
										die('Error: ' . mysqli_error($con));
									}
									echo "Record Added";
									}
								}
?>