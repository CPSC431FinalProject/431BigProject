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
						while($row = mysqli_fetch_array($result)) : ?>
						<li>
							<div class='post-title'><?php echo $row['clubName']; ?></a></div>
							<div class='post-details'><?php echo $row['profile']; ?></a></div>
						</li>
				
						
					<?php endwhile;?>
					</ul>					
            </div>
        <!-- /main -->
        </div>
<?php

include('footer.html');
?>