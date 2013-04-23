<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];
if ($_SESSION['STATUS'] == 'ADMIN'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'forum';
			include_once('adminHeader.html');
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'forum';
		include_once('header.html');
	}	
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
			
			//query the database for all the items inside the thread table to populate the forum
			$tblName = "Thread";
			$sql = "SELECT * FROM $tblName ORDER BY id DESC";
			$result = mysqli_query($con,$sql);
			?>

			<ul class="archive">
			<table border="1">
			<tr>
				<th><strong>#</strong></td>
				<th><strong>Topic</strong></td>
				<th><strong>Views</strong></td>
				<th><strong>Replies</strong></td>
				<th><strong>Date/Time</strong></td>
			</tr>
			
			<?php 
				//populate the forum page with thread titles and description
			while(@$rows = mysqli_fetch_array($result)) 
			{ ?>
				<tr>
					<td><?php echo $rows['id']; ?></td>
					<td><a href="viewThread.php?id=<? echo $rows['id']; ?>"><? echo $rows['Title']; ?></a></td>
					<td><?php echo $rows['Views']; ?></td>
					<td><?php echo $rows['Reply']; ?></td>
					<td><?php echo $rows['DateTime']; ?></td>
				</tr>
			<?php
			//Exit while loop 
			} ?>
				
			<tr>
				<td></td>
				<td><a href="createForumTopic.php"><strong>Create New Topic</strong></a></td>
			</tr>
			</table>
			</ul>
			
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

        
