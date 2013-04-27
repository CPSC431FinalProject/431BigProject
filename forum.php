<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

$_SESSION['NAV'] = 'forum';
include('decideStatus.php');

//Get clubname that was passed in url
$clubname = $_GET['id'];
$username = $_SESSION['currentUser'];

?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">
			
      	    <h2><a href="forum.php?id=<?php echo $clubname; ?>"><?php echo $clubname; ?> Forum</a></h2>
			
			<?php
			
			//Check to see if current user is a member of the club
			$tblName = "clubMembers";
			$sql = "SELECT * FROM $tblName WHERE clubName = '$clubname' AND userName = '$username' LIMIT 1";
			$result = mysqli_query($con,$sql);
			
			//if user isnt in the club then dont populate the forum
			if(mysqli_num_rows($result) == 1)
			{
				//query the database for all the items inside the thread table to populate the forum
				$tblName = "Thread";
				$sql = "SELECT * FROM $tblName WHERE clubName = '$clubname' ORDER BY id DESC";
				$result = mysqli_query($con,$sql);
				?>

				<ul class="archive">
				<table border="1">
				<tr>
					<th></th>
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
						<td></td>
						<td>
							<a href="viewThread.php?id=<? echo $rows['id']; ?>&club=<?php echo $clubname; ?>">
								<? echo $rows['Title']; ?>
							</a>
						</td>
						<td><?php echo $rows['Views']; ?></td>
						<td><?php echo $rows['Reply']; ?></td>
						<td><?php echo $rows['DateTime']; ?></td>
					</tr>
				<?php
				//Exit while loop 
				} 
			
				if(isset($_SESSION['STATUS']))
				{ ?>
				
					<tr>
						<td></td>
						<td><a href="createForumTopic.php?id=<?php echo $clubname; ?>"><strong>Create New Thread</strong></a></td>
					</tr>
				<?php
				} // exit if statement to check for club admin
				?>
			
			
				</table>
				</ul>
				
			<?php
			}
			else
			{
				echo "<h2><center>Members only area</center></h2>";
			} ?>
			
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

        
