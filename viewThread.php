<?php
session_start();

if(!isset($_SESSION['currentUser'])){
   header("Location:index.php");
}

//Connection to the database
//$con=mysqli_connect("ecsmysql","cs431s24","meifithi","cs431s24");
include_once('mysql.connect.php');

//Get the current users name
$currentUser = $_SESSION['currentUser'];

$_SESSION['NAV'] = 'forum';
$tblName="thread";

//Get the value of the id from the address bar
$id = $_GET['id'];

//include the header file
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
			
			<?php
			$sql = "SELECT * FROM $tblName WHERE id = '$id'";
			$result = mysqli_query($con,$sql);
			$rows = mysqli_fetch_array($result)
			?>
			
				<table border="1">
				<tr>
					<td><strong><?php echo $rows['Topic']; ?></strong></td>
				</tr>
				
				<tr>
					<td><?php echo $rows['Detail']; ?></td>
				</tr>
				
				<tr>
					<td><strong>By : </strong> <?php echo $rows['Username']; ?></td>
				</tr>
				
				<tr>
					<td><strong>DateTime: </strong><?php echo $rows['DateTime']; ?></td>
				</tr>
			<?php
			
			$tblName2 = "post"; //Switch the table to query from
			$sql2 = "SELECT * FROM $tblName2 WHERE post_id = '$id'";
			$result2 = mysqli_query($con,$sql2);
			while($rows = mysqli_fetch_array($result2))
			{ ?>
			
			<table border="1">
			<tr>
				<td><table border="1">
				<tr>
					<td><strong>ID</strong></td>
					<td>:</td>
					<td><?php echo $rows['a_id']; ?></td>
				</tr>
				<tr>
					<td><strong>Date/Time</strong></td>
					<td>:</td>
					<td><?php echo $rows['aDateTime']; ?></td>
				</tr>
				</table></td>
			</tr>
			</table>
			
			<?php
			}
			
			$sql3 = "SELECT view FROM $tblName WHERE id = '$id'";
			$result3 = mysqli_query($con,$sql3);
			$rows = mysqli_fetch_array($result3);
			$view = $rows['view'];
			
			//if no counter value set counter to 1
			if(empty($view))
			{
				$view = 1;
				$sql4 = "INSERT INTO $tblName(view) VALUES('$view') WHERE id = '$id'";
				$result4 = mysqli_query($con,$sql4);
			}
			
			//count more value
			$addView = $view + 1;
			$sql5 = "update $tblName set view = '$addView' WHERE id = '$id'";
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