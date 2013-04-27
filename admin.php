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



/* Code to add a user to the clubMembers table */

if(!empty($_POST['clubname']) && !empty($_POST['info']))
{
	//get value of the drop down list
	$value = $_POST['myDropDown'];			

	
	if($value == 'newClubAdmin')
	{ 
		//add club member to clubMembers table
		
		
		//
		//
		//TODO: check to see if there is already a club admin before inserting admin
		//
		//
		$sql = "INSERT INTO clubMembers (clubName,userName,clubAdmin)VALUES('".$_POST['clubname']."','".$_POST['info']."','1')";
		$result = mysqli_query($con,$sql);
		
		if($result)
		{
			$return = "<html><body onload=\"alert('Submitted Successfully');\"></body></html>";
		}
		else
		{
			$return = "<html><body onload=\"alert('Failed to add user to club.');\"></body></html>";
		}
	}
	
	elseif($value == 'banUser')
	{
		//remove club member from clubMembers table
		$sql = "DELETE FROM clubMembers WHERE userName = '".$_POST['info']."' AND clubName = '".$_POST['clubname']."'";
		$result = mysqli_query($con,$sql);
		
		if($result)
		{
			$return = "<html><body onload=\"alert('Member removed from club');\"></body></html>";
		}
		else
		{
			$return = "<html><body onload=\"alert('Failed to remove user from club.');\"></body></html>";
		}
		
	}
	
	elseif($value == 'clubDescription')
	{
		//Change club description
		$sql = "INSERT INTO clubs (clubName,picture,profile) VALUES('".$_POST['clubname']."','images/".$_POST['clubname'].".jpg','".$_POST['info']."')";
		$result = mysqli_query($con,$sql);
		
		if($result)
		{
			$return = "<html><body onload=\"alert('Successfully changed');\"></body></html>";
		}
		else
		{
			$return = "<html><body onload=\"alert('Failed to change description.');\"></body></html>";
		}
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