<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];

$_SESSION['NAV'] = 'clubs';
include('decideStatus.php');

//connection to the database
include_once "mysql.connect.php";
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
<?php
//query the database to get the items inside clubs table to populate the available clubs
$sql = "SELECT * FROM clubs ";
$result = mysqli_query($con,$sql);
?>
<!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="clubs.php">Clubs</a><div class='post-details'></h2>
				
					<ul class="archive">
					<?php
						//populate clubs from the database
						while($row = mysqli_fetch_array($result)) : 
							$clubname = $row['clubName'];
							echo "<li>";
							echo "<div class='post-title'><a href='clubProfile.php?id=".$clubname."'>".$clubname."</a></div>";
							echo "<div class='post-details'>".$row['profile']."</div>";
							echo "</li>";
						endwhile;?>
					</ul>					
            </div>
        <!-- /main -->
        </div>
<?php

include('footer.html');
?>