<?php 
  session_start(); 
  $currentUsername = $_SESSION['username'];
  if (!isset($currentUsername)) {
  	header('location: login.php');
  }

  include('config.php');
  // DB CONNECTION
  $link = mysqli_connect($host,$user,$pw,$db);
  $primeQuery = "SELECT * FROM users WHERE username='$currentUsername'";
  $result = mysqli_query($link, $primeQuery);
  $row = mysqli_fetch_array($result);

  if($row['approved']==0){
  	header('location: home.php');
  }
  if($row['isAdmin']!=0){
  	header('location: admin.php');
  }
?>



<!DOCTYPE html>
<html>
<head>
	<title>Edit Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="edit.css">
	<script src="jquery/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div class="tab">
	  <button id="defaultOpen" class="tablinks" onclick="openCity(event, 'personal')">Personal Information</button>
	  <button class="tablinks" onclick="openCity(event, 'pw')">Change Password</button>
	  <button class="tablinks" onclick="openCity(event, 'social')">Social Media</button>
	</div>
	<div id="personal" class="tabcontent">
		<h1>Personal Information</h1>
		<form method="post" action="edit2.php">
			<table>
				<tr>
					<th>Picture</th>
					<td><input type="file" name="avatar" accept="image/png, image/jpeg"></td>
				</tr>
				<tr>
					<th>First Name</th>
					<td><input type="text" name="firstname" placeholder=" <?php echo $row['firstName']; ?> "></td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td><input type="text" name="lastname" placeholder=" <?php echo $row['lastName']; ?> "></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><input type="text" name="email" placeholder=" <?php echo $row['email']; ?> "></td>
				</tr>
				<tr>
					<th>Bio</th>
					<td><textarea name="bio" rows="5" cols="33" placeholder=" <?php echo $row['bio']; ?> "></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button type="submit" class="btnOutline2" name="updatePersonal">Update Personal Information</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="pw" class="tabcontent">
		<h1>Change Password</h1>
		<form onsubmit="return checkPwd()" method="post" action="edit2.php">
			<table>
				<tr>
					<th>Current Password</th>
					<td><input type="password" name="oldpw" required></td>
				</tr>
				<tr>
					<th>New Password</th>
					<td><input type="password" id="newpw" name="newpw" required></td>
				</tr>
				<tr>
					<th>Confirm New Password</th>
					<td><input type="password" id="cnewpw" name="cnewpw" required></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button type="submit" class="btnOutline2" name="updatePw">Update Password</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="social" class="tabcontent">
		<h1>Social Media</h1>
		<form method="post" action="edit2.php">
			<table>
				<tr>
					<th>Facebook username</th>
					<td><input type="text" name="facebook" placeholder=" <?php echo $row['facebook']; ?> "></td>
				</tr>
				<tr>
					<th>Instagram username</th>
					<td><input type="text" name="instagram" placeholder=" <?php echo $row['instagram']; ?> "></td>
				</tr>
				<tr>
					<th>Twitter username</th>
					<td><input type="text" name="twitter" placeholder=" <?php echo $row['twitter']; ?> "></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button type="submit" class="btnOutline2" name="updateSocial">Update Social Media</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<a class="btnOutline2" href="home.php">Back to Home</a>
	
<script>
	document.getElementById("defaultOpen").click();

	function openCity(evt, cityName) {
	  // Declare all variables
	  var i, tabcontent, tablinks;

	  // Get all elements with class="tabcontent" and hide them
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }

	  // Get all elements with class="tablinks" and remove the class "active"
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }

	  // Show the current tab, and add an "active" class to the button that opened the tab
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " active";

	  	  
	}

	function checkPwd() {

		const newpwd = document.getElementById('newpw').value;
	  	const retype = document.getElementById('cnewpw').value;

	  	if(newpwd!=retype) {
	  		alert('new password and retype is not the same');
	  		return false;
	  	}
	  	else {
	 		return true;
		}

	}


</script>
</body>
</html>