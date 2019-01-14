<?php

  if (isset($_SESSION['username'])) {
  	header('location: home.php');
  }
?>
<?php include('server.php') ?>
<?php include 'header.php' ?>


<form method="post" action="login.php" autocomplete="off">
	<table>
		<tr>
			<td colspan="2"><h1 id="textRegister">Login</h1></td>
		</tr>
		<tr>
			<td colspan="2"><?php include('errors.php'); ?></td>
		</tr>
		<tr>
			<th>Username</th>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2"><button type="submit" class="btnOutline" name="login_user">Login</button></td>
		</tr>
		<tr>
			<td colspan="2"><p>Not yet register? <a href="register.php">Register Now</a></p></td>
		</tr>
	</table>
</form>

</header>



<?php include 'footer.php' ?>

<style>

	#textRegister {
		margin: 0 120px;
	}

	body {
		overflow: hidden
	}
	
	nav {
		display: none;
	}

	footer {
		margin: -200px 0;
	}

	p {
		text-align: center;
		margin-top: 16px;
	}

	p a{
		text-decoration: none;
		width: 50px;
		height: 25px;
		background-color: #2ecc71;
		color: white;
		padding: 8px;
		border-radius: 3px;
	}

	button {
		margin: 0 130px;
		cursor: pointer;
	}
</style>
