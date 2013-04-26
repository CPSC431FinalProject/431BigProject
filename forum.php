<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

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
			} 
			
			if($_SESSION['STATUS'] == "clubAdmin" || $_SESSION['STATUS'] == "ADMIN")
			{ ?>
				
				<tr>
					<td></td>
					<td><a href="createForumTopic.php"><strong>Create New Topic</strong></a></td>
				</tr>
			<?php
			} // exit if statement to check for club admin
			?>
			
			
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

        
