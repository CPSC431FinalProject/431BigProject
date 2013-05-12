<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];
$clubname = $_POST['clubDropDown'];

$_SESSION['NAV'] = 'clubAdmin';

include('decideStatus.php');

//connection to the database
include_once "mysql.connect.php";




/* Code to add a user to the clubMembers table */

if($_POST['clubDropDown'] != 'temp' && !empty($_POST['info']))
{
	//get value of the drop down list
	$value = $_POST['myDropDown'];			

	
	if($value == 'appClubMem')
	{ 
		//add club member to clubMembers table
		$sql = "INSERT INTO clubMembers (clubName,userName,clubAdmin)VALUES('$clubname','".$_POST['info']."','0')";
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
		$sql = "DELETE FROM clubMembers WHERE userName = '".$_POST['info']."' AND clubName = '$clubname'";
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
		$sql = "UPDATE clubs SET profile = '".$_POST['info']."' WHERE clubName = '$clubname'";
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

if($_POST['clubDropDown'] != 'temp' && !empty($_FILES['clubPic']))
{
	$value = $_POST['myDropDown'];
  
	if($value == 'clubPicture')
	{
		$clubPic = $_FILES['clubPic'];
		
		//check to see if clubname exists
		$sql = "SELECT * FROM clubs WHERE clubName = '" . $clubname . "'";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			//Change club picture
			if($clubPic['size'] < 1000000)
			{
				if($clubPic['type'] == "image/jpg" 
				|| $clubPic['type'] == "image/jpeg")
				{
					if($clubPic['error'] > 0)
					{
						echo "Return Code: " . $clubPic['error'] . "<br />";
					}
					else
					{
						move_uploaded_file($clubPic['tmp_name'], "images/" . $clubname . ".jpg");
						$sql2 = "UPDATE clubs SET picture = 'images/$clubname.jpg'";
						$result2 = mysqli_query($con,$sql2);
						if($result2)
						{
							$return = "<html><body onload=\"alert('Club image changed.');\"></body></html>";
						}
					}
				}
				else
				{
					$return = "<html><body onload=\"alert('Wrong file type.');\"></body></html>";
				}
			}
			else
			{
				$return = "<html><body onload=\"alert('File too big.');\"></body></html>";
			}
		}
		else
		{
			$return = "<html><body onload=\"alert('Club does not exist.');\"></body></html>";
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
			
			<?php include('clubAdminForm.html'); ?>			

        <!-- /main -->
        </div>
<?php
include_once('footer.html');
?>
