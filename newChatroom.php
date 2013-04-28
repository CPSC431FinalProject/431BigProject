<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];
$_SESSION['NAV'] = 'chat';
include('decideStatus.php');

//connection to the database
include_once "mysql.connect.php";
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">

      	    <h2><a href="chat.php">Chatrooms</a></h2>
      	    <br /><br />
      	    <div id="">
      	    	<div id="">
				<?php 
					include('newChatroomForm.html');
				?>
				</div>
			</div>					
				
			<!-- /main-content -->		
            </div>

        <!-- /main -->
        </div>
<?php
include('footer.html');

if(!empty($_POST['title']))
{
	$tblName = "chatroom";
	$title = $_POST['title'];
	$sql = "INSERT INTO $tblName (userName,title) VALUES('$currentUser','$title')";
	$result = mysqli_query($con,$sql);

	if($result)
	{
		//successful popup
	}
	else
	{
		//failed popup
	}
}