<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];
$_SESSION['NAV'] = 'forum';
include('decideStatus.php');
//get clubname from url
$clubname = $_GET['id'];


?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">
			
      	    <h2><a href="forum.php?id=<?php echo $clubname; ?>"><?php echo $clubname; ?> Forum</a></h2>
			
			<div class="tableWrapper">
				<div class="newTopicForm"><h3>Create New Thread</h3>
					<div id="form1">
						<form id="form1" name="form1" method="post" action="addForumTopic.php">
							<input type="hidden" name="clubname" id="clubname" value="<?php echo $clubname; ?>" />
							Title:<br /><input name="topic" type="text" id="topic" size="50" /><br />
							Description:<br /><textarea name="detail" cols="50" rows="1" id="detail"></textarea>
							<input type="submit" name="submit" value="Submit" />
							<input type="reset" name="submit2" value="Reset" />
						</form>
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
