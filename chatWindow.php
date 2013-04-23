<?php 
session_start();

if(isset($_POST['submit']))
{
	if($_POST['message'] != NULL)
	{
		include_once "mysql.connect.php";

		$message=$_POST['message'];
		$sender=$_SESSION['currentUser'];
		$sql ="INSERT INTO message(message, sender)VALUES('$message', '$sender')";
		$result = mysqli_query($con, $sql);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Chat</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script language="javascript" src="jquery-1.2.6.min.js"></script>
<script language="javascript" src="jquery.timers-1.0.0.js"></script>
<script type="text/javascript">


$(document).ready(function(){
   //$(document).attr({ scrollTop: $(document).attr("scrollHeight") });
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
				$sender = $('#post_sender').val();
				$text = $('#post_text').val();
				j.ajax({
					type: "POST",
					cache: false,
					url: "save.php",
					//data: "sender"+$sender+"text="+$text,
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
<form method="POST" name="" action="" class="scrollbar">
<div class="refresh">
<?php
include_once "mysql.connect.php";

$sql = "SELECT * FROM message ORDER BY id DESC LIMIT 10";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result))
  {
  echo '<p>'.'<span class="chat_sender">'.$row['sender'].':</span>'. '&nbsp;&nbsp;&nbsp;' . $row['message'].'</p>';
  }

?>

</div>
<br>
<input name="message" type="text" id="textb"/>
<input name="submit" type="submit" value="Chat" id="post_button" />
</form>
</body>
</html>