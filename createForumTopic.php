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
			$sql = "SELECT * FROM $tblName";
			$result = mysqli_query($con,$sql);
			
			?>
			
			<div class="tableWrapper">
				<div class="newTopicForm">Create New Topic
					<div id="form1">
						<form id="form1" name="form1" method="post" action="addForumTopic.php">
							Title:<br /><input name="topic" type="text" id="topic" size="50" /><br />
							Description:<br /><textarea name="detail" cols="50" rows="2" id="detail"></textarea>
							<input type="submit" name="submit" value="Submit" />
							<input type="reset" name="submit2" value="Reset" />
					</div>
				</div>
			</div>
			
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
