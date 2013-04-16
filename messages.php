<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}
$currentUser = $_SESSION['currentUser'];

?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome</title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/coolblue.css" />

    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>

</head>

<body id="top">

<!--header -->
<div id="header-wrap"><header>

 	<hgroup>
        <h1><a href="messasges.php">Messages</a></h1>
    </hgroup>

    <nav>
		<ul>
			<li> <a href="home.php">Home</a><span></span></li>
			<li id="current"><a href="#messages.html">Messages</a><span></span></li>
			<li><a href="settings.php">User Settings</a><span></span></li>
		</ul>
	</nav>

    <div class="logout">
        <span><?php $currentUser = $_SESSION['currentUser']; echo $currentUser; ?></span> <a href="logout.php">Logout</a>
    </div>

   <form id="quick-search" method="get" action="home.php">
      <fieldset class="search">
         <label for="qsearch">Search:</label>
         <input class="tbox" id="qsearch" type="text" name="qsearch" value="Search..." title="Start typing and hit ENTER" />
         <button class="btn" title="Submit Search">Search</button>
      </fieldset>
   </form>

<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">

            <div class="main-content">

      	    <h2><a href="index.html">Messages</a></h2>

					<ul class="archive">

						<li>
							<div class="post-title"><a href="home.php">Suspendisse bibendum.</a></div>
							<div class="post-details"><a href="deleteMsg.php">Delete</a> 
						</li>
					</ul>					
            </div>
        <!-- /main -->
        </div>

        <!-- sidebar -->
		<div id="sidebar">

      	    <div class="about-me">

         	    <h3>User</h3>

                <p>
		        <a href="home.php"><img src="images/gravatar.jpg" width="42" height="42" alt="firefox" class="align-left" /></a>
                We could add a users image here, thats a requirement?
			    </p>

            </div>

			<div class="sidemenu">

				<h3>Additional Navigation</h3>
                <ul>
					<li><a href="home.php">Chat</a></li>
					<li><a href="home.php#TemplateInfo">Forum</a></li>
				</ul>

			</div>
			
        <!-- /sidebar -->
		</div>

    <!-- content -->
	</div>

<!-- /content-out -->
</div>
		
<!-- extra -->
<div id="extra-wrap"><div id="extra" class="clearfix">
<!-- /extra -->
</div></div>

<!-- footer -->
<footer>

	<p class="footer-left">
		Design by Ivan Linan, Pernilla Andersson, Kenny Ascheri
	</p>

	<p class="footer-right">
	   	<a href="http://wang.ecs.fullerton.edu/cpsc431/">CPSC 431 Database and Web Applications</a>
    </p>

<!-- /footer -->
</footer>

</body>
</html>
