<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];

//Get the value of the id from the address bar
$clubname = $_GET['id'];
$_SESSION['NAV'] = 'clubs';
include('decideStatus.php');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">
			
			<?php
			$tblName = "clubs";
			$sql = "SELECT * FROM $tblName WHERE clubName = '$clubname'";
			$result = mysqli_query($con,$sql);
			$rows = mysqli_fetch_array($result);		
			
      	    echo "<h2><a href='clubs.php?id=".$rows['clubName']."'>".$rows['clubName']."</a></h2>";
      	    
      	    ?>
				<div id="profile-wrapper">
					
					<div id="picture">
						<?php echo "<img src='".$rows['picture']."'>"; ?>
					</div>
					
					<div id="description">
						<p>
							<?php echo $rows['profile']; ?>
						</p>
					</div>
					<div id="button">
						<form name="form1" method="post" action="addClubMember.php">
							<input name="username" type="hidden" value="<?php echo $username; ?>">
							<input name="clubName" type="hidden" value="<?php echo $clubname; ?>">
							<input type="submit" name="Submit" value="Join the Club!">
						</form>
					</div>
				</div>	
			
			<!-- /main-content -->
            </div>

        <!-- /main -->
        </div>
<?php
include('footer.html');
?>