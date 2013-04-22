<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];


if ($_SESSION['STATUS'] == 'ADMIN'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'clubs';
			include_once('adminHeader.html');
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'clubs';
		include_once('header.html');
	}	

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
							<div class='post-title'>Club: <?php echo $row['clubName']; ?></a></div>
							<div class='post-title'>Description: <?php echo $row['profile']; ?></a></div>
						</li>
				
						
					<?php endwhile;?>
					</ul>					
            </div>
        <!-- /main -->
        </div>
<?php

include('footer.html');
?>