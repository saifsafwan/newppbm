<?php 
session_start();

if (!isset($_SESSION['username'])) {
	header('location: login.php');
}

include('config.php');

$currentUsername = $_SESSION['username'];
  // DB CONNECTION
$link = mysqli_connect($host, $user, $pw, $db);
$primeQuery = "SELECT * FROM users WHERE username='$currentUsername'";
$result = mysqli_query($link, $primeQuery);
$row = mysqli_fetch_array($result);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Home | PPBM</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="home.css">
	<script src="jquery/jquery-3.3.1.min.js"></script>
	<link rel="apple-touch-icon" sizes="180x180" href="img/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png">
	<link rel="manifest" href="img/icons/site.webmanifest">
	<link rel="mask-icon" href="img/icons/safari-pinned-tab.svg" color="#da0000">
	<link rel="shortcut icon" href="img/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-config" content="img/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
</head>
<body>
	<div class="overlayLocked">
		<h1>Registration Successful!</h1>
		<h2>Your account is not approved by Admin yet!</h2>
		<a class="logoutBtn" href="logout.php">Logout</a>
	</div>
	<div class="overlaySuccess">
		<img src="img/shield.png">
		<h1>Your account has been activated!</h1>
    </div>
    <div class="grid-container">
        <div class="header">
            <img src="img/whitelogo.png" alt="PPBM logo">
            <a class="editBtn" href="edit.php">Edit Details</a>
	  		<a class="logoutBtn" href="logout.php">Logout</a>
        </div>
        <div class="left"></div>
        <div class="right"></div>
        <div class="mainHeader">
            <div class="avatar">
                <img src="img/<?php echo $row['profilePic']; ?>" alt="avatar">
            </div>
            <div class="textName">
                <h1><?php
																			echo $row['firstName'];
																			echo " ";
																			echo $row['lastName'];
																			?>
                </h1>
            </div>
            <div class="social">
            <?php
											$urlFB = "https://www.facebook.com/" . $row['facebook'];
											$urlIG = "https://www.instagram.com/" . $row['instagram'];
											$urlTW = "https://www.twitter.com/" . $row['twitter'];

											if ($row['facebook'] == null || $row['facebook'] == "") {
												echo "<a class='default' id='facebook' href='#'><img src='img/facebook.png'></a>";
											} else {
												echo "<a id='facebook' href='$urlFB'><img data-alt-src='img/facebook.gif' src='img/facebook.png'></a>";
											}

											if ($row['instagram'] == null || $row['instagram'] == "") {
												echo "<a class='default' id='instagram' href='#'><img src='img/instagram.png'></a>";
											} else {
												echo "<a id='instagram' href='$urlIG'><img data-alt-src='img/instagram.gif' src='img/instagram.png'></a>";
											}

											if ($row['twitter'] == null || $row['twitter'] == "") {
												echo "<a class='default' id='twitter' href='#'><img src='img/twitter.png'></a>";
											} else {
												echo "<a id='twitter' href='$urlTW'><img data-alt-src='img/twitter.gif' src='img/twitter.png'></a>";
											}

											?>
            </div>
        </div>
        <div class="bio">
            <p>
            <?php echo $row['bio']; ?>
            </p>
        </div>
        <div class="footer"></div>
    </div>
    <script type="text/javascript">
		
		let checkLock = <?php echo $row['approved']; ?>;
		console.log(checkLock);
		const classSelect = document.querySelector('.overlayLocked');


		if (checkLock==0){
			classSelect.style.display = 'block';
		}
		else {
			$(document).ready(function() {
			    if(sessionStorage.getItem('popState') != 'shown'){
			        $(".overlaySuccess").delay(2000).fadeIn();
			        sessionStorage.setItem('popState','shown')
			    }

			    $('.overlaySuccess-close').click(function(e) // You are clicking the close button
			    {
			    $('.overlaySuccess').fadeOut(); // Now the pop up is hiden.
			    });
			    $('.overlaySuccess').click(function(e) 
			    {
			    $('.overlaySuccess').fadeOut(); 
			    });
			});
		}
	</script>
	<script type="text/javascript">

		let checkfb = "<?php echo $row['facebook']; ?>";
		if(checkfb==null || checkfb==""){
			console.log('do nothing!');
		} else {
			var sourceSwap = function () {
		        var $this = $(this);
		        var newSource = $this.data('alt-src');
		        $this.data('alt-src', $this.attr('src'));
		        $this.attr('src', newSource);
		    }

		    $(function() {
		        $('img[data-alt-src]').each(function() { 
		            new Image().src = $(this).data('alt-src'); 
		        }).hover(sourceSwap, sourceSwap); 
		    });
		}
		
	</script>
</body>
</html>