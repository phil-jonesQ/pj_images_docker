<?php
echo "hello";
$servername = "localhost";
$username = "pj_images";
$password = "Ma5t3r00ts007#";
$dbname = "pj-images";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = 'INSERT INTO assets VALUES (0,"TestImage4.jpg","Nikon","D700","AE",100,\'2013:06:22 14:05:48\',"28mm",16.0,"4597x3045","1/320","Landscape",0,1,9,100,now())';

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

