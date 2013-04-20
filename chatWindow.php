<?php 
session_start();

if(isset($_POST['submit']))
{
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//mysql_select_db("chat", $con);
		$message=$_POST['message'];
		$sender=$_POST['sender'];
		$sql ="INSERT INTO message(message, sender)VALUES('$message', '$sender')";
		$result = mysqli_query($con, $sql);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Chat</title>
<script language="javascript" src="jquery-1.2.6.min.js"></script>
<script language="javascript" src="jquery.timers-1.0.0.js"></script>
<script type="text/javascript">

$(document).ready(function(){
   var j = jQuery.noConflict();
	j(document).ready(function()
	{
		j(".refresh").everyTime(1000,function(i){
			j.ajax({
			  url: "refresh.php",
			  cache: false,
			  success: function(html){
				j(".refresh").html(html);
			  }
			})
		})
		
	});
	j(document).ready(function() {
			j('#post_button').click(function() {
				$text = $('#post_text').val();
				j.ajax({
					type: "POST",
					cache: false,
					url: "save.php",
					data: "text="+$text,
					success: function(data) {
						alert('data has been stored to database');
					}
				});
			});
		});
   j('.refresh').css({color:"green"});
});
</script>

</head>
<body>
<form method="POST" name="" action="">
<div class="refresh">
<?php
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//mysql_select_db("chat", $con);

$sql = "SELECT * FROM message ORDER BY id DESC";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result))
  {
  echo '<p>'.'<span>'.$row['sender'].'</span>'. '&nbsp;&nbsp;' . $row['message'].'</p>';
  }

//mysql_close($con);
?>

</div>
<input name="message" type="text" id="textb"/>
<input name="submit" type="submit" value="Chat" id="post_button" />
</form>
</body>
</html>
