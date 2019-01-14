<?php
  
  //starting session 
  session_start();

  //set variable to session's username
  $currentUsername = $_SESSION['username'];

  //if session is not set, means the user is not logged in; hence, direct the user to login page
  if (!isset($currentUsername)) {
  	header('location: login.php');
  }
  //including database info
  include('config.php'); 

  
  // DB CONNECTION
  $link = mysqli_connect($host,$user,$pw,$db);
  $approvedText = "Active";
  $notApprovedText = "Pending Approval";
  $primeQuery = "SELECT * FROM users WHERE username='$currentUsername'";
  $result = mysqli_query($link, $primeQuery);
  $row = mysqli_fetch_array($result);

  if($row['isAdmin']==0){
  	echo "<script>console.log('I come from admin.php')</script>";
  	header('location: home.php');
  	
  }
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard | PPBM</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="admin.css">
	<script src="jquery/jquery-3.3.1.min.js"></script>
</head>
<body>

	<div class="pageTitle">Admin Dashboard</div>
	<a class="logoutBtn" href="logout.php">Logout</a>
	<div class="tab">
	  <button id="defaultOpenAdmin" class="tablinks" onclick="openTab(event, 'all')">All Users</button>
	  <button class="tablinks" onclick="openTab(event, 'pending')">Pending Approval Users</button>
	  <button class="tablinks" onclick="openTab(event, 'findUser')">Find Users</button>
	</div>
	<div id="all" class="tabcontent">
		<h1>All Users</h1>
		<form>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th>No</th>
					<th><a href="?sort=1">Username</a></th>
					<th><a href="?sort=2">First Name</a></th>
					<th><a href="?sort=3">Last Name</a></th>
					<th><a href="?sort=4">Email</a></th>
					<th><a href="?sort=5">Status</a></th>
					<th><a href="?sort=6">Last Seen</a></th>
					<th>Action</th>
				</tr>
				<?php 

				if (isset($_GET["sort"])){
					if ($_GET["sort"]==1)		
						$sql="select * from users WHERE id<>4 order by username";
					else if ($_GET["sort"]==2)
						$sql="select * from users WHERE id<>4 order by firstName";
					else if ($_GET["sort"]==3)
						$sql="select * from users WHERE id<>4 order by lastName";
					else if ($_GET["sort"]==4)
						$sql="select * from users WHERE id<>4 order by email";
					else if ($_GET["sort"]==5)
						$sql="select * from users WHERE id<>4 order by approved";
					else if ($_GET["sort"]==6)
						$sql="select * from users WHERE id<>4 order by lastSeen";
					else 
						$sql="select * from users WHERE id<>4";
				}

				else
					$sql="select * from users WHERE id<>4";
					
				$rs = mysqli_query($link,$sql);

				$x=1;
				
				date_default_timezone_set("Asia/Kuala_Lumpur");
  				$datetime1 = date('Y-m-d H:i:s');
				echo "<script>console.log('<?php echo $datetime1; ?>');</script>";
				
				while ($row=mysqli_fetch_array($rs)) {
					echo "<tr>";
					echo	"<td>".$x."</td>";
					echo	"<td>".$row['username']."</td>";
					echo	"<td>".$row['firstName']."</td>";
					echo	"<td>".$row['lastName']."</td>";
					echo	"<td>".$row['email']."</td>";
					echo	"<td>";
					if($row['approved']==1) { echo "<span style='color: #4cd137;'>Active</span>"; } else { echo "<span style='color: #e84118;'>Pending Approval <img src='img/pending.gif'> </span>"; }
					echo 	"</td>";

					$datetime1Obj = DateTime::createFromFormat('Y-m-d H:i:s', $datetime1); //return object

					$dateInDB = $row['lastSeen'];
					$dateInDBObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateInDB); //return object

					$interval = $datetime1Obj->diff($dateInDBObj);
					$elapsed = $interval->format('%h hours %i minutes');
					$wordLastSeen = "Last seen " . $elapsed . " ago";

					echo 	"<td>" .$wordLastSeen."</td>";
					echo	"<td><span class='tooltip'><a class=\"confirmation\" href=\"?deleteUser=". $row['id']. "\"><img src='img/bin.png'></a><span class='tooltiptext'>Delete User</span></span>";

						if(isset($_GET["deleteUser"])){
							$thisID = (int)$_GET['deleteUser'];
							$query = "DELETE FROM users WHERE id='$thisID'";
	  						mysqli_query($link,$query);
	  						header('location: admin.php');
						}

						if($row['approved']==0) {
							echo "<span class='tooltip'>
									<img src='img/approve.png' onclick=" . " \"openTab(event, 'pending')\" " . ">
								  	<span class='tooltiptext'>Approve User</span>
								  </span>";
						}
					echo 	"</td>";
					echo "</tr>";
					$x++;
				}



				?>
			</table>
		</form>
	</div>
	<div id="pending" class="tabcontent">
		<h1>Pending Approval Users</h1>
		<form>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th>No</th>
					<th><a href="?sort=1">Username</a></th>
					<th><a href="?sort=2">First Name</a></th>
					<th><a href="?sort=3">Last Name</a></th>
					<th><a href="?sort=4">Email</a></th>
					<th><a href="?sort=5">Status</a></th>
					<th>Action</th>
				</tr>
				<?php 

				if (isset($_GET["sort"])){
					if ($_GET["sort"]==1)		
						$sql="select * from users where approved='0' AND id<>4 order by username";
					else if ($_GET["sort"]==2)
						$sql="select * from users where approved='0' AND id<>4 order by firstName";
					else if ($_GET["sort"]==3)
						$sql="select * from users where approved='0' AND id<>4 order by lastName";
					else if ($_GET["sort"]==4)
						$sql="select * from users where approved='0' AND id<>4 order by email";
					else if ($_GET["sort"]==5)
						$sql="select * from users where approved='0' AND id<>4 order by approved";
					else 
						$sql="select * from users where approved='0' AND id<>4";
				}

				else
					$sql="select * from users where approved='0' AND id<>4";
					
				$rs = mysqli_query($link,$sql);

				$x=1;
				while ($row=mysqli_fetch_array($rs)) {
					echo "<tr>";
					echo	"<td>".$x."</td>";
					echo	"<td>".$row['username']."</td>";
					echo	"<td>".$row['firstName']."</td>";
					echo	"<td>".$row['lastName']."</td>";
					echo	"<td>".$row['email']."</td>";
					echo	"<td>";
					if($row['approved']==1) { echo "<span style='color: #4cd137;'>Active</span>"; } else { echo "<span style='color: #e84118;'>Pending Approval <img src='img/pending.gif'> </span>"; }
					echo "</td>";
					echo 	"<td>";
					echo 	"<a href=\"?setApprove=". $row['id']. "\">Approve User</a>";

					
					if(isset($_GET["setApprove"])){
						$thisID = (int)$_GET['setApprove'];
						$query = "UPDATE users SET approved=1 WHERE id='$thisID'";
							mysqli_query($link,$query);
							header('location: admin.php');
					}
					

					echo 	"</td>";
					echo "</tr>";
					$x++;
				}
				?>
			</table>
		</form>
	</div>
	<div id="findUser" class="tabcontent" style="height: 550px;">
		<iframe align="center" width="100%" height="100%" src="search.php" frameborder="none" scrolling="none" name="myIframe" id="myIframe"> </iframe>
	</div>


	<script>
		document.getElementById("defaultOpenAdmin").click();

		function openTab(evt, cityName) {
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
		};
	</script>
	<script type="text/javascript">
	    $('.confirmation').on('click', function () {
	        return confirm('Are you sure?');
	    });
	</script>
	
</body>
</html>