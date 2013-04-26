<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];

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
			
			
      	    <h2><a href="forum.php">Forum</a></h2>
			
			<?php
			//Store variables retrieved from POST
			$title = $_POST['topic'];
			$detail = $_POST['detail'];
			$tblName = "Thread";
			
			$today = date("F j, Y, g:i a");
			
			$sql = "INSERT INTO $tblName(Username,Title,Detail,DateTime)" . 
				"VALUES('$currentUser','$title','$detail','$today')";
			$result = mysqli_query($con,$sql);
			
			if($result) 
			{
				echo "Successful\t";
				echo "<a href=forum.php>View your topic</a>";
			}
			else
			{
				echo "ERROR";
			}
			?>
			
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
