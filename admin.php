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

/* Code to add a new club*/

if(!empty($_POST['newClub']) && !empty($_POST['clubDescription']))
	{
		//grab the new club name
		$newClub = $_POST['newClub'];
		
		$picture = '';
		
		//grab the clubs description
		$description = $_POST['clubDescription'];
	

		//prepare the mysql query to insert into clubs table
			$sql="INSERT INTO clubs (clubName, picture, profile)
			VALUES
			('$newClub','$picture', '$description')";
			if(!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
				$return = "<html><body onload=\"alert('Submitted');\"><p>New Club Added.</p></body></html>";
				print($return);
		//printf("Select returned %d rows.\n", mysqli_num_rows($result));
	}
?>