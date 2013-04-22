<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
//connection to the database
include_once "mysql.connect.php";

//grab the current users name
$currentUser = $_SESSION['currentUser'];

if ($_SESSION['STATUS'] == "ADMIN"){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'messages';
			
			//query the database to get the items inside mailbox table to populate the users messages
			//pass the number of messages in the inbox into the header, so that the navigation bar will dispay the # of messages in the inbox
			$sql = "SELECT * FROM mailbox WHERE receiver = '$currentUser'";
			if ($stmt = mysqli_prepare($con, $sql)) {

			/* execute query */
			mysqli_stmt_execute($stmt);

			/* store result */
			mysqli_stmt_store_result($stmt);
			}		
			//pass the number of messages into the header through a session variable
			$_SESSION['numMessages']= $stmt;
			include_once('adminHeader.html');
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'messages';
		//query the database to get the items inside mailbox table to populate the users messages
		//pass the number of messages in the inbox into the header, so that the navigation bar will dispay the # of messages in the inbox
		$sql = "SELECT * FROM mailbox WHERE receiver = '$currentUser'";
		//$result = mysqli_stmt_num_rows($sql);
			
		//pass the number of messages into the header through a session variable
		$_SESSION['numMessages']= $result;
		include_once('header.html');
	}	

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