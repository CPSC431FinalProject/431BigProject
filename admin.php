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

//get value of the drop down list
$value = $_POST['myDropDown'];	


if(!empty($_POST['clubname']) && !empty($_POST['info']))
{	
	if($value == 'newClubAdmin')
	{ 
		//check to see if username is a user first
		$sql = "SELECT * FROM users WHERE userName = '".$_POST['info']."'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 1)
		{
			//add club member to clubMembers table
			//check to see if user is already in the club
			$sql2 = "SELECT * FROM clubMembers WHERE userName = '".$_POST['info']."' AND clubName = '".$_POST['clubname']."'";
			$result2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($result2) == 0)
			{
				$sql3 = "INSERT INTO clubMembers (clubName,userName,clubAdmin)VALUES('".$_POST['clubname']."','".$_POST['info']."','1')";
				$result3 = mysqli_query($con,$sql3);
				if($result3)
				{
					$return = "<html><body onload=\"alert('Submitted Successfully');\"></body></html>";
				}
			}
			else
			{
				$return = "<html><body onload=\"alert('User already a member of that club.';\"></body></html>";
			}
		}
	}
	
	elseif($value == 'clubDescription')
	{
		//make sure club doesnt exist
		$sql = "SELECT * FROM clubs WHERE clubName = '".$_POST['clubname']."'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 0)
		{
			//Change club description
			$sql2 = "INSERT INTO clubs (clubName,picture,profile) VALUES('".$_POST['clubname']."','images/".$_POST['clubname'].".jpg','".$_POST['info']."')";
			$result2 = mysqli_query($con,$sql2);
		
			if($result2)
			{
				$return = "<html><body onload=\"alert('Successfully changed');\"></body></html>";
			}
		}
		else
		{
			$return = "<html><body onload=\"alert('Club already exists.');\"></body></html>";
		}
			
	}
	print $return;
	
}	
elseif(!empty($_POST['info']))
{
	if($value == 'banUser')
	{
		//check to see if user exists
		$sql = "SELECT * FROM users WHERE userName = '".$_POST['info']."' LIMIT 1";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			//update status of user in users table to ban
			$sql2 = "UPDATE users SET status = 'BAN' WHERE userName = '".$_POST['info']."'";
			$result2 = mysqli_query($con,$sql2);
		
			if($result2)
			{
				$return = "<html><body onload=\"alert('Member banned from the site');\"></body></html>";
			}
		}
		else
		{
			$return = "<html><body onload=\"alert('User does not exist.');\"></body></html>";
		}	
	}
	else
	{
		$return = "<html><body onload=\"alert('Failed to complete request.');\"></body></html>";
	}
	print $return;
}

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
?>