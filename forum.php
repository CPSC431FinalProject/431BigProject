<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];


if ($_SESSION['STATUS'] == 'ADMIN'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			include_once('adminHeader.html');
			$_SESSION['NAV'] = 'forum';
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'forum';
		include_once('header.html');
	}	

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

      	    <h2><a href="forum.php">Forum</a></h2>					
            </div>

        <!-- /main -->
        </div>
<?php
include('footer.html');
?>