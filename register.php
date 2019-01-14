<?php include('server.php') ?>
<?php include 'header.php' ?>

<?php

  if (isset($_SESSION['username'])) {
  	header('location: home.php');
  }
?>

<form method="post" action="register.php" autocomplete="off">
	<table>
		<tr>
			<td colspan="2"><h1 id="textRegister">Registration</h1></td>
		</tr>
		<tr>
			<td colspan="2"><?php include('errors.php'); ?></td>
		</tr>
		<tr>
			<th>Username</th>
			<td><input type="text" name="username" value="<?php echo $username; ?>" ></td>
		</tr>
		<tr>
			<th>First Name</th>
			<td><input type="text" name="firstName"></td>
		</tr>
		<tr>
			<th>Last Name</th>
			<td><input type="text" name="lastName"></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><input type="email" name="email" value="<?php echo $email; ?>" ></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password1"></td>
		</tr>
		<tr>
			<th>Confirm Password</th>
			<td><input type="password" name="password2"></td>
		</tr>
		<tr>
			<td colspan="2">*By registering, you agree to our Terms of Services
				<button type="submit" class="btnOutline" name="reg_user">Register</button></td>
		</tr>
		<tr>
			<td colspan="2"><p>Already a member? <a href="login.php">Sign in</a></p></td>
		</tr>
	</table>
</form>

</header>



<?php include 'footer.php' ?>

<style>

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
