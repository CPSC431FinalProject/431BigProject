<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
include_once "mysql.connect.php";
//grab the current user name
$currentUser = $_SESSION['currentUser'];

$admin = "admin";
$_SESSION['NAV'] = 'home';
include('decideStatus.php');


//Connect to the database
include_once "mysql.connect.php";
?>

<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">

      	    <article class="post">

      		    <div class="primary">

                    <h2><a href="home.php">Welcome</a></h2>


               	    <div class="image-section">
              		    <img src="images/img-post.jpg" alt="image post" height="206" width="498"/>
         	        </div>

                </div>
		    </article>

         

        <!-- /main -->
        </div>
<?php
include('footer.html');
?>