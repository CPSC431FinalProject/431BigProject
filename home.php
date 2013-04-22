<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
include_once "mysql.connect.php";
//grab the current user name
$currentUser = $_SESSION['currentUser'];

$admin = "admin";
//query the database to see if the user that just logged in has admin priviladges
$sql = "SELECT * FROM users WHERE userName = '$currentUser'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
if ($row['status'] == "admin"){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'home';
			$_SESSION['STATUS'] = "ADMIN";
			include('adminHeader.html');
			$_SESSION['NAV'] = 'home';
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'home';
		include('header.html');
		$_SESSION['STATUS'] = 'USER';
	}	
		
//grab the session type to know which type of pages the user is able to get
//$_SESSION['NAV'] = 'home';
//include('header.html');
//$time = date('G:ia');


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