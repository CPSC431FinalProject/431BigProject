<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];

if ($_SESSION['STATUS'] == 'ADMIN'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			include_once('adminHeader.html');
			$_SESSION['NAV'] = 'settings';
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'settings';
		include_once('header.html');
	}	

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

      	    <h2><a href="settings.php">Change Password</a></h2>					
            </div>
			
			<?php
			include_once('settingsForm.html');
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
		$sql = "SELECT * FROM `users` WHERE userName = '$currentUser'";
		$result = mysqli_query($con,$sql);
		$rows = mysqli_num_rows($result); 
		if ($rows['password'] == $oldPassword){
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