<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];
$_SESSION['NAV'] = 'admin';

if($_SESSION['STATUS'] == "ADMIN")
	{
		//WHERE ALLOWED TO BE IN HERE
	}
	else{
		header("Location:home.php");
	}
include_once('adminHeader.html');
//connection to the database
include_once "mysql.connect.php";
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">

      	    <h2><a href="admin.php">Admin Settings</a></h2>					
            </div>
			
			<?php
			include_once('adminForm.html');
			?>

        <!-- /main -->
        </div>
<?php
include_once('footer.html');

/* Code to change the password of a user */

if(!empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['passwordConfirm']))
	{
		//grab the old password
		$oldPassword = $_POST['oldPassword'];
		
		//hash the old password to see if it matches the hashed version in the database table
		$oldPassword = md5($oldPassword);

		// this is where we check to see if the user exists in the database
		//create sql string to retrieve the string from the database table "users"
		$sql = "SELECT * FROM `users` WHERE userName = '$currentUser' AND password = '$oldPassowrd'";
		$result = mysqli_query($con,$sql);
		
		if (mysqli_num_rows($result) == 1){
			//since we know that the user has the correct old password, we can now change the password
			$newPassword = $_POST['newPassword'];
			$passwordConfirm = $_POST['passwordConfirm'];
			
			//check to see if the two passwords, match
			if( $newPassword == $passwordConfirm)
				{
					//insert the new password into the database
					$newPassword = md5($newPassword);
					$sql="UPDATE users  SET password='$newPassword' WHERE `userName`='$currentUser'";
					$result = mysqli_query($con,$sql);
					
					$return = "<html><body onload=\"alert('Submitted');\"><p>Submission successful.</p></body></html>";
				}
			else{
					$return = "<html><body onload=\"alert('Submitted');\"><p>Passwords Don't match</p></body></html>";
			}
		
		}else{
			 $return ="<html><body onload=\"alert('Submitted');\"><p>Incorrect Passw</p></body></html>";
		}
		print $return;
		//printf("Select returned %d rows.\n", mysqli_num_rows($result));
	}
?>