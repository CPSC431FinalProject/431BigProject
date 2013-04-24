<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];

$_SESSION['NAV'] = 'clubAdmin';

if($_SESSION['STATUS'] == "clubAdmin")
	{
		include('clubAdminHeader.html');
	}
	else{
		header("Location:home.php");
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

      	    <h2><a href="clubAdmin.php">Club Settings</a></h2>					
            </div>
			
			<?php
			include_once('clubAdminForm.html');
			?>

        <!-- /main -->
        </div>
<?php
include_once('footer.html');
?>