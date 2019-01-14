<?php
session_start();
include('config.php');
// initializing variables
$username = "";
$email    = "";
$avatar   = "avatar.png";
$errors = array(); 

// connect to the database
$db = mysqli_connect($host,$user,$pw,$db);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $fname = mysqli_real_escape_string($db, $_POST['firstName']);
  $lname = mysqli_real_escape_string($db, $_POST['lastName']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($fname)) { array_push($errors, "First Name is required"); }
  if (empty($lname)) { array_push($errors, "Last Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password1)) { array_push($errors, "Password is required"); }
  if ($password1 != $password2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, firstName, lastName, email, password, signUpDate, profilePic, approved, isAdmin) 
  			  VALUES('$username', '$fname', '$lname', '$email', '$password', CURRENT_TIMESTAMP, '$avatar', 0, 0)";
  	$insertQuery = mysqli_query($db, $query);
    if(!$insertQuery) {
      echo "ERROR" . mysqli_error($db);
      header("Refresh: 5;url=login.php");
    }
    else {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: home.php');
    }

  	
  }
}

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_array($results);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      if($row['isAdmin']==41){
        // echo $row['isAdmin'];
        header("location: admin.php");
        echo "<script>console.log('I come from server.php')</script>";

      }
      else if($row['isAdmin']==0) {
        // echo $row['isAdmin'];
        header("location: home.php");
        echo "<script>console.log('I come from server.php')</script>";
      }
      else { array_push($errors, "Got error somewhere!"); }
      
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>