<?php
	
	//Connect to database
	
	$servername = "localhost";
	$username = "pj_admin";
	$password = "0verl0rds007#";
	$dbname = "pj-images";

	//define("HOST", "localhost");     // The host you want to connect to.
	//define("USER", "pj_admin");    // The database username.
	//define("PASSWORD", "0verl0rds007#");    // The database password.
	//define("DATABASE", "pj-images");    // The database name.

	
	//Create Connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	//Check Connection
	if (!$conn) {
		die("Connection failed:". mysqli_connect_error());	
	}
	
	// Define constants
	
	define("VERSION", "V1.001");
	define("DOCROOT", "/pjadmin001");
	define("DOMAIN_URL","http://www.pj-images.com");
	
	// Make image of the day random
	
	$sql="select id,filename from assets where imageTitle != 'Image Not Defined' order by rand() desc LIMIT 1"; 
	$result = mysqli_query($conn, $sql);
	$img_of_the_day = mysqli_fetch_assoc($result);
	
	//define("IMAGE_OF_THE_DAY", "Forrest_1_of_1.jpg");
	//define("IMAGE_OF_THE_DAY_ID", 826);
	
	define("IMAGE_OF_THE_DAY", $img_of_the_day['filename']);
	define("IMAGE_OF_THE_DAY_ID", $img_of_the_day['id']);
?>
