<?php
include_once '/home/alfa/includes/psl-config_pj-images.php';
// Create connection
$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql="select id,filename from assets where imageTitle != 'Image Not Defined' order by rand() desc LIMIT 1"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        shellprint ("$row[filename]|$row[id]");
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
function shellprint($string)
{
    echo($string . "\n");
}

?>
