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
					$tblName = "chatroom";
					$sql = "SELECT * FROM $tblName";
					$result = mysqli_query($con,$sql);
					if(mysqli_num_rows($result) == 0) :
						echo "<h3><center>No Open Chatrooms</center></h3>";
					else:
						echo "<div id=''>";
						while($row = mysqli_fetch_array($result)) : ?>
							<div id="">
							<a href="chatroom.php?id=<?php echo $row['CRNo']; ?>">
								<?php echo $row['title']; ?>&nbsp&nbsp&nbsp&nbsp&nbspStarted By: <?php echo $row['userName']; ?>
							</a>
							</div>
						<?php endwhile;
						echo "</div>";
					endif; ?>
					
					
						<table border='0'>
						<tr>
							<table border='0'>
							<tr>
								<td>
									<form id="createChatroom" method="post" action="newChatroom.php">
										<input type="submit" name="submit" value="Create Chatroom" />
									</form>	
								</td>
							</tr>
							</table>
						</tr>
						</table>
					
				</div>
			</div>					
				
			<!-- /main-content -->		
            </div>

        <!-- /main -->
        </div>
<?php
include('footer.html');
?>