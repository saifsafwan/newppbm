<?php 


	include('config.php'); 
	$link = mysqli_connect($host,$user,$pw,$db);
	$primeQuery = "SELECT * FROM users";
	$result = mysqli_query($link, $primeQuery);
	$row = mysqli_fetch_array($result);




	date_default_timezone_set("Asia/Kuala_Lumpur");
	$datetime1 = date('Y-m-d H:i:s');
	echo "<script>console.log('<?php echo $datetime1; ?>');</script>";
	$format = 'Y-m-d H:i:s';
	$timezone = new DateTimeZone('Asia/Kuala_Lumpur');
	echo "datetime1 is ".gettype($datetime1). "<br>";


	while($row){
		
		$datetime1Obj = DateTime::createFromFormat('Y-m-d H:i:s', $datetime1); //return object

		$dateInDB = $row['lastSeen'];
		$dateInDBObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateInDB); //return object

		$interval = $datetime1Obj->diff($dateInDBObj);
		$elapsed = $interval->format('%a days %h hours %i minutes');
		$wordLastSeen = "Last seen " . $elapsed;

		echo 	"<h1>" .$wordLastSeen."</h1>";
	}
	






















 ?>