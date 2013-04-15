<?php ob_start();?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
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
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="">
                </a>
                <span class="right">
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
            </header>
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form method = "post" action="index.php" autocomplete="on"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="userLog" name="userLog" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="passLog" name="passLog" required="required" type="password" placeholder="Password" /> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form method = "post" action="index.php" autocomplete="on"> 
                                <h1> Sign up </h1>
								<p>
								<label for="realName" class="realName" data-icon="u">Your Name</label>
                                    <input id="realName" name="realName" required="required" type="text" placeholder="First and Last Name" />
								</p>
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="User Name" />
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
							<?php
							//This is the code for the login information
							
							//use session variables to log in
							session_start();
							
							$con=mysqli_connect("ecsmysql","cs431s24","meifithi", "cs431s24");
							// Check connection
							if (mysqli_connect_errno())
							  {
							  echo "Failed to connect to MySQL: " . mysqli_connect_error();
							  }
							
							
							//*************************************Let's Verify and see if the user can login****************************
							
							
							//get the username and password
							if(!empty($_POST['userLog']) && !empty($_POST['passLog']))
							{
								//set the username and password variables from the form
								$username = $_POST['userLog'];
								$password = $_POST['passLog'];
								$passwordHash = md5($password);
								

								//create sql string to retrieve the string from the database table "users"
								$sql = "SELECT * FROM `users` WHERE userName = '$username' AND password = '$passwordHash'";
								$result = mysqli_query($con,$sql);
								
								if (mysqli_num_rows($result) == 1){
									$_SESSION['currentUser'] = $username;
									header("Location: home.html"); 
									//$return = "<font color=#008000><Center><b>**Successful Login**</b></Center></font>";
								}else{
									 $return = "<font color=#ff0000><Center><b>**Failed Login**</b></Center></font>";
								}
								//used for debugging
								//printf("Select returned %d rows.\n", mysqli_num_rows($result));
								print($return);
							}
							
							
							//**********************************This is the code to register a new user************************************
							if(!empty($_POST['realName']) && !empty($_POST['usernamesignup']) && !empty($_POST['passwordsignup']) && !empty ($_POST['passwordsignup_confirm'])){
								$passWord = $_POST['passwordsignup'];
								$passWord2 = $_POST['passwordsignup_confirm'];
								$realName = $_POST['realName'];
								$usernamesignup = $_POST['usernamesignup'];
								
								/* Used when trying to run a seperate register page.
								$_SESSION['usernamesignup'] = $passWord;
								$_SESSION['passWord2'] = $passWord2;
								$_SESSION['realName'] = $realName;
								$_SESSION['usernamesignup'] = $usernamesignup;*/
								
								if($passWord != $passWord2)
									{
										echo "Please Input a matching password";
									}
								else{
									$passWord = md5($passWord);
									$sql="INSERT INTO users (UserFullName, userName , password)
										VALUES
										('$_POST[realName]','$_POST[usernamesignup]','$passWord')";
									if(!mysqli_query($con,$sql))
									{
										die('Error: ' . mysqli_error($con));
									}
									header("home.php");
									}
								}
							
							?>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>