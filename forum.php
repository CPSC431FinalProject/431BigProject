<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];
$_SESSION['NAV'] = 'forum';
include('header.html');
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