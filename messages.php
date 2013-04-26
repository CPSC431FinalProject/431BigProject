<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
//connection to the database
include_once "mysql.connect.php";

//grab the current users name
$currentUser = $_SESSION['currentUser'];

$_SESSION['NAV'] = 'messages';
include('decideStatus.php');

?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
<?php
//query the database to get the items inside mailbox table to populate the users messages
$sql = "SELECT * FROM mailbox WHERE receiver = '$currentUser' ORDER BY id DESC";
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
						while($row = mysqli_fetch_array($result)) : 
							echo "<li>";
							if($row['status'] == 'New') :
								echo "<div class='post-title' style='background-color:yellow'>";
							else :
								echo "<div class='post-title'>";
							endif; ?>
								<a href="viewMessage.php?id=<?php echo $row['id']; ?>"><?php echo $row['subject']; ?></a></div>
							<div class='post-details'>	From: <?php echo $row['sender']; ?></a></div>
							<div id='post-details-time-stamp'><?php echo $row['dateTime'];?></div>
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