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
$clubname = $_POST['clubname'];
$_SESSION['NAV'] = 'forum';
include('decideStatus.php');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">
			
			
      	    <h2><a href="forum.php?id=<?php echo $clubname; ?>"><?php echo $clubname; ?> Forum</a></h2>
			
			<?php
			
			//Find highest answer number.
			$sql = "SELECT MAX(id) MaxID FROM $tblName WHERE ThreadNo = '$id'";
			$result = mysqli_query($con, $sql);
			$rows = mysqli_fetch_array($result);
			
			$sql2 = "SELECT MIN(id) MinID FROM $tblName WHERE ThreadNo = '$id'";
			$result2 = mysqli_query($con, $sql2);
			$rows2 = mysqli_fetch_array($result2);
			
			//add 1 to highest answer number and set it to "$MaxID". 
			//If not set, set it to 1
			
			if($result && $result2)
			{
				$MaxID = $rows['MaxID']-$rows2['MinID'];
				if($MaxID == 0)
					$MaxID = 1;
			}
			
			//get values from form
			$aName = $currentUser;
			$aAnswer = $_POST['aAnswer'];
			
			$today = date("F j, Y, g:i a");
			
			//Insert post
			$sql2 = "INSERT INTO $tblName(Username, Text, DateTime, ThreadNo)VALUES('$aName','$aAnswer','$today','$id')";
			$result2 = mysqli_query($con,$sql2);
			
			if($result2)
			{
				echo "Successful\t";
				echo "<a href='viewThread.php?id=$id&club=$clubname'>View your answer</a>";
				
				//If added new answer, add value + 1 in reply column
				$tblName2 = "Thread";
				$MaxID ++;
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
