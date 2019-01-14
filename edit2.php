<?php

session_start(); 

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }

include('config.php'); 

$currentUsername = $_SESSION['username'];
// DB CONNECTION
$link = mysqli_connect($host,$user,$pw,$db);

//-1. GENERAL QUERY TO LOGGED IN USERNAME ONLY
$primeQuery = "SELECT * FROM users WHERE username='$currentUsername'";
$result = mysqli_query($link, $primeQuery);
$rowNo = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($row['approved']==0){
  	header('location: home.php');
}
if($row['isAdmin']!=0){
  	header('location: admin.php');
 }

?>

<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
	<style type="text/css">
		body {
			font-family: 'Montserrat', sans-serif;
		}
	</style>
</head>
<body>

<?php

// ---------------REAL THINGS HAPPEN HERE --------------------------
if($rowNo==1){
	if(!empty($_POST['avatar'])){
		$navatar = mysqli_real_escape_string($link, $_POST['avatar']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET profilePic='$navatar' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>avatar is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>avatar not updated</h1></div>";
	}
	if(!empty($_POST['firstname'])){
		$nfirstname = mysqli_real_escape_string($link, $_POST['firstname']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET firstName='$nfirstname' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>firstname is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>firstName not updated</h1></div>";
	}
	if(!empty($_POST['lastname'])){
		$nlastname = mysqli_real_escape_string($link, $_POST['lastname']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET lastName='$nlastname' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>lastname is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>lastName not updated</h1></div>";
	}
	if(!empty($_POST['email'])){
		$nemail = mysqli_real_escape_string($link, $_POST['email']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET email='$nemail' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>email is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>email not updated</h1></div>";
	}
	if(!empty($_POST['newpw']) && !empty($_POST['oldpw'])){
		$npw = mysqli_real_escape_string($link, $_POST['newpw']);
		$old = md5(mysqli_real_escape_string($link, $_POST['oldpw']));
		$currentUsername = $_SESSION['username'];
		if($row['password']==$old) {
			$npw = md5($npw);
			$updateQuery = "UPDATE users SET password='$npw' WHERE username='$currentUsername'";
			mysqli_query($link, $updateQuery);
			echo "<div class='show'><h1>newpw is UPDATED</h1></div>";
		} else {
			echo "<div class='hide'><h1>old password is false</h1></div>";
		}
	}
	else {
		echo "<div class='hide'><h1>password not updated</h1></div>";
	}
	if(!empty($_POST['bio'])){
		$bio = mysqli_real_escape_string($link, $_POST['bio']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET bio='$bio' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>bio is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>bio not updated</h1></div>";
	}
	if(!empty($_POST['facebook'])){
		$fb = mysqli_real_escape_string($link, $_POST['facebook']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET facebook='$fb' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>facebook is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>facebook not updated</h1></div>";
	}
	if(!empty($_POST['instagram'])){
		$ninsta = mysqli_real_escape_string($link, $_POST['instagram']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET instagram='$ninsta' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>instagram is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>instagram not updated</h1></div>";
	}
	if(!empty($_POST['twitter'])){
		$ntwit = mysqli_real_escape_string($link, $_POST['twitter']);
		$currentUsername = $_SESSION['username'];
		$updateQuery = "UPDATE users SET twitter='$ntwit' WHERE username='$currentUsername'";
		mysqli_query($link, $updateQuery);
		echo "<div class='show'><h1>twitter is UPDATED</h1></div>";
	} else {
		echo "<div class='hide'><h1>twitter not updated</h1></div>";
	}
}
else {
	echo "<div class='hide'><h1>you are not having session</h1></div>";
}
header("Refresh: 1;url=home.php");
 ?>

 <style type="text/css">
 	.show {
 		text-align: center;
 		background-color: #55efc4;
 		padding: 20px;
 		border-radius: 10px;
 		margin-top: 30px;
 	}

 	.show h1 {
 		color: white;
 	}

 	.hide {
 		text-align: center;
 		background-color: #ff7675;
 		padding: 20px;
 		border-radius: 10px;
 		display: none;
 	}

 	.hide h1 {
 		color: white;
 	}
 </style>

 </body>