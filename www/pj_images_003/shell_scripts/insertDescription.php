<?php
$servername = "localhost";
$username = "pj_images";
$password = "Ma5t3r00ts007#";
$dbname = "pj-images";

$my_input_id=$argv[1];
$my_input_title=$argv[2];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//insert into asset_description VALUES (0,(select id from assets where id = 1),(select imageTitle from assets where id =1));
//$sql = 'INSERT INTO assets VALUES (0,"TestImage4.jpg","Nikon","D700","AE",100,\'2013:06:22 14:05:48\',"28mm",16.0,"4597x3045","1/320","Landscape",0,1,9,100,now())';

$sql="insert into asset_description VALUES (0,'$my_input_id','$my_input_title')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

