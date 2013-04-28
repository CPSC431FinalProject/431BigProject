<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];

$_SESSION['NAV'] = 'clubAdmin';

if($_SESSION['STATUS'] == "clubAdmin")
	{
		include('clubAdminHeader.html');
	}
	else{
		header("Location:home.php");
	}
//connection to the database
include_once "mysql.connect.php";




/* Code to add a user to the clubMembers table */

if(!empty($_POST['clubname']) && !empty($_POST['info']))
{
	//get value of the drop down list
	$value = $_POST['myDropDown'];			

	
	if($value == 'appClubMem')
	{ 
		//add club member to clubMembers table
		$sql = "INSERT INTO clubMembers (clubName,userName,clubAdmin)VALUES('".$_POST['clubname']."','".$_POST['info']."','0')";
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
	
	elseif($value == 'remClubMem')
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
		$sql = "UPDATE clubs SET profile = '".$_POST['info']."' WHERE clubName = '".$_POST['clubname']."'";
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

      	    <h2><a href="clubAdmin.php">Club Settings</a></h2>					
            </div>
			
			<?php
			include_once('clubAdminForm.html');
			?>

        <!-- /main -->
        </div>
<?php
include_once('footer.html');
?>
