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
if ($_SESSION['STATUS'] == 'ADMIN'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['NAV'] = 'forum';
			include_once('adminHeader.html');
		}
	else{
		//grab the session type to know which type of pages the user is able to get
		$_SESSION['NAV'] = 'forum';
		include_once('header.html');
	}	
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
			$rows = mysqli_fetch_array($result)
			?>
				<table border="1">
				<tr>
					<th><strong><?php echo $rows['Topic']; ?></strong></th>
					<th><?php echo $rows['Detail']; ?></th>
					<th><strong>By: </strong><?php echo $rows['Username'] ?></td>
					<th><strong>DateTime: </strong><?php echo $rows['DateTime'] ?></td>
		
				</tr>
			<?php
			
			$tblName2 = "Post"; //Switch the table to query from
			$sql2 = "SELECT * FROM $tblName2 WHERE ThreadNo = '$id'";
			$result2 = mysqli_query($con,$sql2);
			while($rows = mysqli_fetch_array($result2))
			{ ?>
			
				<tr>
					
					<td><table border="1">
					<tr>
						<td><?php echo $rows['Text']; ?></td>
					<tr>
						<td><strong>By</strong></td>
						<td>:</td>
						<td><?php echo $rows['Username']; ?></td>
					</tr>
					<tr>
						<td><strong>Date/Time</strong></td>
						<td>:</td>
						<td><?php echo $rows['DateTime']; ?></td>
					</tr>
					</table></td>
				</tr>
				</table>
			
			<?php
			}
			
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
						<td valign="top"><strong>Answer</strong></td>
						<td valign="top">:</td>
						<td><textarea name="aAnswer" cols="45" rows="3" id="aAnswer"></textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
						<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
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