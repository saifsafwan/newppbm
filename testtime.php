<?php 


include('config.php');
$link = mysqli_connect($host, $user, $pw, $db);
$primeQuery = "SELECT * FROM users";
$result = mysqli_query($link, $primeQuery);
$row = mysqli_fetch_array($result);




use Carbon\Carbon;

require 'vendor/autoload.php';

$dt = Carbon::now('Asia/Kuala_Lumpur');

while ($row) {

	$dateInDB = $row['lastSeen'];
	$dateInDBObj = Carbon::createFromFormat('Y-m-d H:i:s', $dateInDB); //return object
	$getAgo = $dateInDBObj->diffForHumans();

	$wordLastSeen = "Last seen " . $getAgo;

	echo "<h1>" . $wordLastSeen . "</h1>";
}























?>