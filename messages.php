<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
//connection to the database
include_once "mysql.connect.php";

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
$sql = "SELECT * FROM mailbox WHERE receiver = '$currentUser'";
$result = mysqli_query($con,$sql);
?>
   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="messages.php">Messages</a><div class='post-details'></h2>
				<div class="navigation clearfix">
						<div><a href="newMessage.php" >New Message</a></div>
				</div>
			
					
					<ul class="archive">
					<?php
						//populate messages from the database
						while($row = mysqli_fetch_array($result)) : ?>
						<li>
							<div class='post-title'>From: <?php echo $row['sender']; ?></a></div>
							<div class='post-title'>Subject: <?php echo $row['subject']; ?></a></div>
							<div id='post-details-time-stamp'><?php echo $row['dateTime'];?></div>
					    <div class='post-details'><?php echo $row['msgText']; $_SESSION['delete_id'] = $row['id'];?>
							<form action="delete.php" method="post" class="delete">
							<input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>" />
						    <input type="submit" class="delete" value="Delete" />
						  </form>
						</li>
				
						
					<?php endwhile;?>
					</ul>					
            </div>
        <!-- /main -->
        </div>
<?php
include('footer.html');
?>