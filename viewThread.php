<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];

$tblName="Thread";

//Get the value of the id from the address bar
$id = $_GET['id'];
$_SESSION['NAV'] = 'forum';
include('decideStatus.php');
?>
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<div class="main-content">
			
			
      	    <h2><a href="forum.php">Forum</a></h2>
			
			<?php
			$sql = "SELECT * FROM $tblName WHERE id = '$id'";
			$result = mysqli_query($con,$sql);
			$rows = mysqli_fetch_array($result);
			?>
				<ul class="archive">
				<li>
					<div class='post-title'><center><?php echo $rows['Title']; ?></center></div>
					<div id='post-details-time-stamp'><?php echo $rows['DateTime']; ?></div>
				</li>
				</ul>
				<ul class="archive">
					<?php
						$tblName2 = "Post"; //Switch the table to query from
						$sql2 = "SELECT * FROM $tblName2 WHERE ThreadNo = '$id'";
						$result2 = mysqli_query($con,$sql2);
						//populate messages from the database
						while($row = mysqli_fetch_array($result2)) : ?>
						<li>
							<div class='post-details'><?php echo $row['Text'];?></div>
							<div id='post-details-time-stamp'><?php echo $row['DateTime']; echo "<br />By:".$row['Username']; ?></div>
						</li>
				
						
					<?php endwhile;?>
				</ul>
				
				
				
				<?php /* ?>
				
				
				
				<table border='1'>
				
				
				
			<?php
			
			
			$tblName2 = "Post"; //Switch the table to query from
			$sql2 = "SELECT * FROM $tblName2 WHERE ThreadNo = '$id'";
			$result2 = mysqli_query($con,$sql2);
			while($rows = mysqli_fetch_array($result2))
			{ ?>
				<tr>					
					<td>
						<?php echo $rows['Text']; ?>
					</td>
					<td>
						By:<?php echo $rows['Username']; ?>
					</td>
					<td>
						Posted at:<?php echo $rows['DateTime']; ?>
					</td>
				</tr>
			
			<?php
			} 
			
			
			
			?>
			
				</table>
				
			<?php   */
			
			$sql3 = "SELECT Views FROM $tblName WHERE id = '$id'";
			$result3 = mysqli_query($con,$sql3);
			$rows = mysqli_fetch_array($result3);
			$view = $rows['Views'];
			
			//if no counter value set counter to 1
			if(empty($view))
			{
				$view = 1;
				$sql4 = "INSERT INTO $tblName(Views) VALUES('$view') WHERE id = '$id'";
				$result4 = mysqli_query($con,$sql4);
			}
			
			//count more value
			$addView = $view + 1;
			$sql5 = "update $tblName set Views = '$addView' WHERE id = '$id'";
			$result5 = mysqli_query($con,$sql5);
			?>
			
			<table border="1">
			<tr>
				<form name="form1" method="post" action="addForumPost.php">
				<td>
					<table border="1">
					<tr>
						<td valign="top"><strong>Say Something</strong></td>
						<td valign="top">:</td>
						<td><textarea name="aAnswer" cols="45" rows="3" id="aAnswer"></textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
						<td><input type="submit" name="Submit" value="Submit">
							<input type="reset" name="Submit2" value="Reset">
						</td>
					</tr>
					</table>
				</td>
				</form>
			</tr>
			</table>
			
			<!-- /main-content -->
            </div>

        <!-- /main -->
        </div>
<?php
include('footer.html');
?>