<?php
session_start();

//if the user status is set already, then no need to re-query the database to get their status, it'll already be stored in session variable
if(!isset($_SESSION['STATUS'])){
			
				//check and see if the user is a club admin	
	$sql = "SELECT clubAdmin FROM clubMembers WHERE userName = '$currentUser'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	if ($row['clubAdmin'] == "1"){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the club admin priviladges page
			$_SESSION['STATUS'] = "clubAdmin";
			include('clubAdminHeader.html');
			$_SESSION['NAV'] = 'home';
		}
			
	//check and see if a user is a full admin
	$sql = "SELECT * FROM users WHERE userName = '$currentUser'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	if ($row['status'] == "admin"){
				//since the result is equal to one, we know that the user is an admin
				//setup to display the admin priviladges page
				$_SESSION['STATUS'] = "ADMIN";
				include('adminHeader.html');
				$_SESSION['NAV'] = 'home';
			}
	//the user was not a club admin, and not a full admin, so must be a regular user
	else if ($row['status'] == ""){
			//grab the session type to know which type of pages the user is able to get
			include('header.html');
			$_SESSION['STATUS'] = 'USER';
		}
			}
	else{
	//check and see if the user is a club admin	
	if ($_SESSION['STATUS'] == 'clubAdmin'){
			//since the result is equal to one, we know that the user is an admin
			//setup to display the admin priviladges page
			$_SESSION['STATUS'] = "clubAdmin";
			include('clubAdminHeader.html');
		}	
	//check and see if a user is a full admin
	if ($_SESSION['STATUS'] == 'ADMIN'){
				//since the result is equal to one, we know that the user is an admin
				//setup to display the admin priviladges page
				$_SESSION['STATUS'] = "ADMIN";
				include('adminHeader.html');
			}
	//the user was not a club admin, and not a full admin, so must be a regular user
	if($_SESSION['STATUS'] == 'USER'){
			//grab the session type to know which type of pages the user is able to get
			$_SESSION['STATUS'] = 'USER';
			include('header.html');
			
		}
}
?>