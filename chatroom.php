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

$id = $_POST['id'];
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
					include('chatWindow.php');
				?>
					
				</div>
			</div>					
				
			<!-- /main-content -->		
            </div>

        <!-- /main -->
        </div>
<?php
include('footer.html');
?>