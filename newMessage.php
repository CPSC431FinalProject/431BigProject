<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
//connection to the database
include_once "mysql.connect.php";

//grab the current users name
$currentUser = $_SESSION['currentUser'];

if ($_SESSION['STATUS'] == "ADMIN"){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'messages';
			include_once('adminHeader.html');
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'messages';
		include_once('header.html');
	}	

?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="messages.php">Inbox</a></h2>
			<?php include('messageForm.html'); ?>
            </div>
        <!-- /main -->
        </div>
	
<?php
include('footer.html');
?>
	</div>
</div>

<?php
//check to see if the user where sending to, exists
if(!empty($_POST['userTo']) && !empty($_POST['message']) && !empty($_POST['subject']))
	{
		//set the username and password variables from the form
		$username = $_POST['userTo'];

		// this is where we check to see if the user exists in the database
		//create sql string to retrieve the string from the database table "users"
		$sql = "SELECT * FROM users WHERE userName = '$username'";
		$result = mysqli_query($con,$sql);
		
		if (mysqli_num_rows($result) == 1){
			//since we know taht the user exists, now we can set the variables to send as a message
			$message = $_POST['message'];
			$subject = $_POST['subject'];
			$sender = $currentUser;
			$status = "New";
			$today = date("F j, Y, g:i a"); 
			
			//prepare the mysql query to insert into mailbox table
			$sql="INSERT INTO mailbox (subject, msgText, sender, receiver, status, dateTime)
			VALUES
			('$subject','$message', '$sender', '$username', '$status', '$today')";
			if(!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
				$return = "<html><body onload=\"alert('Submitted');\"></body></html>";
				print($return);
		}else{
			 $return ="<html><body onload=\"alert('User does not exist.');\"></body></html>";
		}
		print $return;
		//printf("Select returned %d rows.\n", mysqli_num_rows($result));
	}
?>