<?php
	require_once("server.php");
	if (!isset($_SESSION["username"]))
	    die("Session is not active. Please log in");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logging Out...</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<h1>Logging Out...</h1>
	<div class='lds-dual-ring'></div>
	<style type="text/css">
		h1 {
			text-align: center;
			margin-top: 27%;
		}
		div {
			width: 200px;
	        height: 800px;

	        position:absolute; /*it can be fixed too*/
	        left:0; right:0;
	        top:0; bottom:0;
	        margin:auto;

	        /*this to solve "the content will not be cut when the window is smaller than the content": */
	        max-width:100%;
	        max-height:100%;
	        overflow:hidden;
		}

		.lds-dual-ring {
		    display: inline-block;
		    width: 64px;
		    height: 64px
		}

		.lds-dual-ring:after {
		    content: '';
		    display: block;
		    width: 46px;
		    height: 46px;
		    margin: 1px;
		    border-radius: 50%;
		    border: 5px solid #c0392b;
		    border-color: #c0392b transparent;
		    animation: lds-dual-ring 1.2s linear infinite
		}

		@keyframes lds-dual-ring {
		    0% {
		        transform: rotate(0)
		    }
		    100% {
		        transform: rotate(360deg)
		    }
		}
	</style>
</body>
</html>
<?php
// destroy the session 
include('config.php'); 

$currentUsername = $_SESSION['username'];
// DB CONNECTION
$link = mysqli_connect($host,$user,$pw,$db);
// $primeQuery = "SELECT * FROM users WHERE username='$currentUsername'";
// $result = mysqli_query($link, $primeQuery);
// $row = mysqli_fetch_array($result);
date_default_timezone_set("Asia/Kuala_Lumpur");

$dateNow = date('Y-m-d H:i:s');
$q = "UPDATE users SET lastSeen='$dateNow' WHERE username='$currentUsername'";
$rs = mysqli_query($link, $q);
if(!$rs){
	echo mysql_errno($link);
}

session_destroy();

header("Refresh: 0.5;url=login.php");
?>