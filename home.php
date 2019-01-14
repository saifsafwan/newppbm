<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }

  include('config.php'); 

  $currentUsername = $_SESSION['username'];
  // DB CONNECTION
  $link = mysqli_connect($host,$user,$pw,$db);
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
	  		<img class="avatar" src="img/<?php echo $row['profilePic']; ?>">
	  		<div class="intro">
	  			<h1>Welcome <?php echo $row['firstName']; ?></h1>
	  			<p>
	  				<?php echo $row['bio']; ?>
	  			</p>
	  			<div class="social">
	  				<a id="facebook" href="https://facebook.com/<?php echo $row['facebook']; ?>"><img data-alt-src="img/facebook.gif" src="img/facebook.png"></a>
	  				<a id="instagram" href="https://instagram.com/<?php echo $row['instagram']; ?>"><img data-alt-src="img/instagram.gif" src="img/instagram.png"></a>
	  				<a id="twitter" href="https://twitter.com/<?php echo $row['twitter']; ?>"><img data-alt-src="img/twitter.gif" src="img/twitter.png"></a>
	  			</div>
	  			
	  		</div>
	  		<a class="editBtn" href="edit.php">Edit Details</a>
	  		<a class="logoutBtn" href="logout.php">Logout</a>
		</div>
		<div class="padding">
	  	
		</div>
		<div class="padding2">
	  		
		</div>
		<div class="mainContainer">
			
		</div>
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