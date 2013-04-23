<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];

$tblName = "Post";

//Get value of id that sent from hidden field
$id = $_POST['id'];
if ($_SESSION['STATUS'] == 'ADMIN'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'forum';
			include_once('adminHeader.html');
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'forum';
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
			
			
      	    <h2><a href="forum.php">Forum</a></h2>
			
			<?php
			
			//Find highest answer number.
			$sql = "SELECT MAX(id) AS MaxID FROM $tblName WHERE ThreadNo = '$id'";
			$result = mysqli_query($con, $sql);
			$rows = mysqli_fetch_array($result);
			
			//add 1 to highest answer number and set it to "$MaxID". 
			//If not set, set it to 1
			
			if($result)
			{
				$MaxID = $rows['id']+1;
			}
			else
			{
				$MaxID = 1;
			}
			
			//get values from form
			$aName = $currentUser;
			$aAnswer = $_POST['aAnswer'];
			
			$datetime = date("d/m/y H:i:s"); //create date and time
			
			//Insert post
			$sql2 = "INSERT INTO $tblName(Username, Text, DateTime, ThreadNo)VALUES('$aName','$aAnswer','$datetime','$id')";
			$result2 = mysqli_query($con,$sql2);
			
			if($result2)
			{
				echo "Successful\t";
				echo "<a href='viewThread.php?id=".$id."'>View your answer</a>";
				
				//If added new answer, add value + 1 in reply column
				$tblName2 = "Thread";
				$sql3 = "UPDATE $tblName2 SET Reply = '$MaxID' WHERE id = '$id'";
				$result3 = mysqli_query($con,$sql3);
			}
			else
			{
				echo "ERROR";
			}	?>
			
			
			<!-- /main-content -->
            </div>

        <!-- /main -->
        </div>
        <?php
		include('footer.html');
		?>
    <!-- /content -->
    </div>

<!-- /content-wrap -->
</div>
