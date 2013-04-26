    
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

//Get message id that was passed in url
$id = $_GET['id'];

?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="messages.php">Messages</a><div class='post-details'></h2>
				<div class="navigation clearfix">
						<div><a href="newMessage.php" >New Message</a></div>
				</div>
			
					
					<ul class="archive">
					<?php
						//query the database to get the items inside mailbox table to populate the users messages
						$sql = "SELECT * FROM mailbox WHERE id = '$id'";
						$result = mysqli_query($con,$sql);
						//populate the desired message
						$rows = mysqli_fetch_array($result); ?>
						<li>
							<div>
								<div>
									Subject: <?php echo $rows['subject']; ?>
								</div>
								<div>
									By: <?php echo $rows['sender']; ?>
								</div>
							</div>
							<div id='post-details-time-stamp'>
								<?php echo $rows['dateTime']; ?>
							</div>
							<div class='post-details'>
								<?php echo $rows['msgText']; ?>
							</div>
							
							<form action="delete.php" method="post" class="delete">
							<input type="hidden" name="delete_id" id="delete_id" value="<?php echo $row['id']; ?>" />
						    <input type="submit" class="delete" value="Delete" />
						    
						    
						  </form>
						</li>
				
					</ul>	
					<?php
						
						//update status of message to be read
						if($result)
						{
							$sql2 = "UPDATE mailbox SET status = 'READ' WHERE id = '$id'";
							$result2 = mysqli_query($con,$sql2);
						}
					?>			
            </div>
        <!-- /main -->
        </div>
<?php
include('footer.html');
?>