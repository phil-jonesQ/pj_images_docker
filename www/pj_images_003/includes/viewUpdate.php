 <?php
function ImageHit($assetID) {
echo $assetID;
// connect to the database
//include_once '/home/alfa/includes/psl-config_pj-images.php';
include_once 'includes/psl-config_pj-images.php';
// Create connection
$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (!$conn) {
    		die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE assets SET views=views +1 where id=$assetID";

if (mysqli_query($conn, $sql)) {
   		   //echo "Record updated successfully";
	} else {
    		echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn); 
}

$my_input_id=$argv[1];
ImageHit($my_input_id);
?>
