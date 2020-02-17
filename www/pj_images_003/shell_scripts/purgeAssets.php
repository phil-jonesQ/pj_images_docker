<?php
// Script to read in json file
// Convert to variables
// Insett into database
// phil jones Feb 2017 (c) all rights reserver


// Connect to DB

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


$sql = "DELETE FROM assets ";

if (mysqli_query($conn, $sql)) {
        shellprint ("Deletion done..");
        } else {
        echo " ";
        shellprint ("Error: " . $sql . "  <br>  " . mysqli_error($conn));
}
   

mysqli_close($conn);

function shellprint($string)
{
    echo($string . "\n");
}

?>
