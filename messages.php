<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];
$_SESSION['NAV'] = 'messages';
include('header.html');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="messages.php">Messages</a></h2>

					<ul class="archive">

						<li>
							<div class="post-title"><a href="home.php">Suspendisse bibendum.</a></div>
							<div class="post-details"><a href="deleteMsg.php">Delete</a> 
						</li>
					</ul>					
            </div>
        <!-- /main -->
        </div>
<?php
include('footer.html');
?>