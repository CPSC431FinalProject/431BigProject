<?php ob_start(); ?>
<head>
<meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
</head>
<body>

<?php 

//connection to the database
$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
//start the session
session_start();
//grab the current user
$currentUser = $_SESSION['currentUser'];
if($currentUser == ""){
	echo "Your Not Logged In ";
}
else{
	echo "You're Logged in as: ". $currentUser;
	?>



	 <div id="container_demo" >
						<a class="hiddenanchor" id="toregister"></a>
						<a class="hiddenanchor" id="tologin"></a>
						<div id="wrapper">
							<div id="login" class="animate form">
								<form method = "post" action="index.php" autocomplete="on"> 
									<h1>Upload</h1> 
									<p> 
										<label for="username" class="uname" data-icon="u" > Photo Name</label>
										<input id="usersImage" name="usersImage" type="text" placeholder="photo name"/>
										<input value = "Search" type = "submit">
									</p>
									<p> 
										<label for="caption" class="caption" data-icon="p"> Search by Caption</label>
										<input id="captionSearch" name="captionSearch" type="text" placeholder="caption text" />
										<input value = "Search" type = "submit">									
									</p>
									<form enctype="multipart/form-data" action="loggedin.php" method="post" name="changer">
									Photo Name: <input type="text" name="photoName"><br>
									<textarea name="caption" cols="25" rows="5">
									Enter Caption
									</textarea><br>
									<input name="MAX_FILE_SIZE" value="102400" type="hidden">
									<input name="image" type="file">
									<input value="Upload" type="submit">
									
									<p class="change_link">
										Sign Out ?
										<a href="logout.php" class="logOut">Log Out</a>
									</p>
								</form>
							</div>
	 <form action="logout.php" method="post">
			<input type="submit" value="Logout" />
		  </form>
	Refresh
	<form>
	<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
	</form>
	<form method = "post" action ="loggedin.php" id ="form">
	Photo Name: <input type="text" name="usersImage"><br>
	<input value = "Submit" type = "submit">
	</form>
	<form method = "post" action ="loggedin.php" id ="form">
	Search by Caption: <input type="text" name="captionSearch"><br>
	<input value = "Submit" type = "submit">
	</form>
	************************Choose an Image to Upload*********************
	<form enctype="multipart/form-data" action="loggedin.php" method="post" name="changer">
	Photo name: <input type="text" name="photoName"><br>
	<textarea name="caption" cols="25" rows="5">
	Enter Caption
	</textarea><br>
	<input name="MAX_FILE_SIZE" value="102400" type="hidden">
	<input name="image" type="file">
	<input value="Upload" type="submit">

	<?php
	//check to see if the user where sending to, exists
	if(isset($_FILES['image']) && $_FILES['image']['size'] > 0 && isset($_POST['photoName']))
		{
			//temporary file name
			// Temporary file name stored on the server
			$tmpName = $_FILES['image']['tmp_name'];
			$imageType = $_FILES['image']['type'];
			$data = file_get_contents($tmpName);
			$data = addslashes($data);
			// Read the file
			//$fp = fopen($tmpName, 'r');
			//$data = fread($fp, filesize($tmpName));
			//$data = addslashes($data);
			//fclose($fp);

			// this is where we check to see if the user exists in the database
			//create sql string to retrieve the string from the database table "users"
			$sql="INSERT INTO photos (photoName, caption, photoData, photoType, userName)
				VALUES
				('$_POST[photoName]','$_POST[caption]','$data','$imageType', '$currentUser')";

			//For debugging purposes
			if(!mysqli_query($con,$sql))
			{
				die('Error: ' . mysqli_error($con));
			}
			else
			{
				echo "Your Image has been Added";
			}	
		}
		if(isset($_POST['usersImage'])){
				//code to show images
				$user = $_POST['usersImage'];
				$sql = "SELECT * FROM `photos` WHERE photoName = '$user'";
				$result = mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result)) 
				{
					switch ($row['photoType']) {
						case 'image/jpeg':
							echo "<br>";
							echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['photoData'] ) . '" />';
							echo '<p id="caption">'.$row['caption'].' </p>';
						break;
						case 'image/png':
							echo '<img src="data:image/png;base64,' . base64_encode( $row['photoData'] ) . '" />';
							echo '<p id="caption">'.$row['caption'].' </p>';
						break;
					}
				}
			}
		if(!empty($_POST['captionSearch'])){
				//code to show images
				$search = $_POST['captionSearch'];
				$sql = "SELECT * FROM `photos` WHERE `caption` REGEXP '([^A-Za-z]($search)[^A-Za-z])'";
				$result = mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result)) 
				{
					switch ($row['photoType']) {
						case 'image/jpeg':
							echo "<br>";
							echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['photoData'] ) . '" />';
							echo '<p id="caption">'.$row['caption'].' </p>';
						break;
						case 'image/png':
							echo '<img src="data:image/png;base64,' . base64_encode( $row['photoData'] ) . '" />';
							echo '<p id="caption">'.$row['caption'].' </p>';
						break;
					}
				}
			}
	}
?>
						</body>
						</div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>
<?php ob_flush(); ?>