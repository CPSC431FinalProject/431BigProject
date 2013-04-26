<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];


//Get value of username and clubName that sent from hidden field
$clubname = $_POST['clubName'];
$_SESSION['NAV'] = 'clubs';
include('decideStatus.php');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">
			
			<?php
			
			
      	    echo "<h2><a href='forum.php?id=".$clubname."'>".$clubname."</a></h2>";
			
			//find the username of the clubAdmin assigned to the specific club in the databse
			$tblName = "users";
			$sql = "SELECT * FROM clubMembers WHERE clubName = '$clubname' AND clubAdmin = '1' LIMIT 1";
			$result = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($result);
				
			//create message information
			$subject = "New club member request";
			$msgText = "Hi ClubAdmin,<br /><br />&nbsp&nbsp&nbsp&nbsp$currentUser would like to join $clubname club. Go to the Club Admin" .
				" page to add the user to your club.<br /><br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".
				"Sincerely,<br />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAdmin";
			$sender = "SYSTEM";
			$receiver = $row['userName'];
			
			//store the message in the mailbox
			$tblName2 = "mailbox";
			//so that "from" field won't be empty, we should make it be from "SYSTEM"
			$from = "SYSTEM";
			$sql2 = "INSERT INTO $tblName2 (subject,msgText,sender,receiver,status,dateTime)
				VALUES
				('$subject','$msgText','$from','$receiver','New',NOW())";
			$result2 = @mysqli_query($con, $sql2);
			$rows = mysqli_fetch_array($result2);
			
			if($result2)
			{
				echo "Successful\t";
				echo "<a href='clubProfile.php?id=".$clubname."'>Back to club profile</a>";
				
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
