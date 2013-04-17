<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
//connection to the database
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");

//grab the current users name
$currentUser = $_SESSION['currentUser'];

//this variable will be used to decide the CSS inside the footer file
$_SESSION['NAV'] = 'messages';

//include the header file
include('header.html');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
<?php
//query the database to get the items inside mailbox table to populate the users messages
$sql = "SELECT * FROM mailbox WHERE sender = '$currentUser'";
$result = mysqli_query($con,$sql);
?>
   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="messages.php">Messages</a></h2>

					<ul class="archive">
					<?php
						//populate messages from the database
						while($row = mysqli_fetch_array($result)) : ?>
						<li>
							<div class='post-title'>From: <?php echo $row['sender']; ?></a></div>
							<div class='post-title'>Subject: <?php echo $row['subject']; ?></a></div>
							<div class='post-details'><?php echo$row['msgText']; ?><a href='deleteMsg.php'>Delete</a> 
						</li>
				
						
					<?php endwhile;?>
					</ul>					
            </div>
        <!-- /main -->
        </div>
<?php
include('footer.html');
?>