<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
//connection to the database
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");

//grab the current users name
$currentUser = $_SESSION['currentUser'];

//this variable will be used to decide the CSS inside the footer file
$_SESSION['NAV'] = 'messages';

//include the header file
include('header.html');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="messages.php">New Message</a></h2>
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
		$sql = "SELECT * FROM `users` WHERE userName = '$username'";
		$result = mysqli_query($con,$sql);
		
		if (mysqli_num_rows($result) == 1){
			//since we know taht the user exists, now we can set the variables to send as a message
			$message = $_POST['message'];
			$subject = $_POST['subject'];
			$sender = $currentUser;
			$status = "New";
			
			//prepare the mysql query to insert into mailbox table
			$sql="INSERT INTO mailbox (messageID, subject, msgText, sender, receiver, status)
			VALUES
			('$messageID','$subject','$message', '$sender', '$username', '$status')";
			if(!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
				$return = "<html><body onload=\"alert('Submitted');\"><p>Submission successful.</p></body></html>";
				print($return);
		}else{
			 $return ="<html><body onload=\"alert('Submitted');\"><p>User does not exist.</p></body></html>";
		}
		print $return;
		//printf("Select returned %d rows.\n", mysqli_num_rows($result));
	}
?>