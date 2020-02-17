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


// Get input file from how we were called

$my_input_file=$argv[1];
   
    //read the json file contents
    $jsondata = file_get_contents($my_input_file);

   //convert json object to php associative array
    $data = json_decode($jsondata, true);

   //Parse
   $arrlength = count($data);

   for($x = 0; $x < $arrlength; $x++) {
    	$filename=$data[$x][FileName];
        $make=$data[$x][Make];
	$model=$data[$x][Model];
	$exposure=$data[$x][ExposureProgram];
	$iso=$data[$x][ISO];
	$focal=$data[$x][FocalLength];
	$createDate=$data[$x][CreateDate];
	$aperture=$data[$x][Aperture];
	$imageSize=$data[$x][ImageSize];
	$shutterSpeed=$data[$x][ShutterSpeed];
	$Category=$data[$x][Category];
	$isGetty=$data[$x][isGetty];
	$isHDR=$data[$x][isHDR];
	$isBW=$data[$x][isBW];
	$pjRank=$data[$x][pjRank];

	//Debug
    	//echo  "file=$filename,make=$make,model=$model,exposure=$exposure,iso=$iso,focal=$focal,date=$createDate,aperture=$aperture,size=$imageSize,speed=$shutterSpeed,cat=$Category,getty=$isGetty,hdr=$isHDR,bw=$isBW,rank=$pjRank";
	//$sql= 'INSERT INTO assets VALUES (0,"TestImage4.jpg","Nikon","D700","AE",100,\'2013:06:22 14:05:48\',"28mm",16.0,"4597x3045","1/320","Landscape",false,false,false,100,now())';
	//$sql = "INSERT INTO assets VALUES (0,'$filename','$make','$model','$exposure','$iso','$createDate','$focal','$aperture','$imageSize','$shutterSpeed','$Category',false,false,false,'$pjRank',now())";
	$sql = "INSERT INTO assets VALUES (0,'Image Not Defined','$filename','$make','$model','$exposure','$iso','$createDate','$focal','$aperture','$imageSize','$shutterSpeed','$Category',false,false,false,'$pjRank',0,now())";
	if (mysqli_query($conn, $sql)) {
                shellprint ("New record created successfully");
        } else {
                echo " ";
                shellprint ("Error: " . $sql . "  <br>  " . mysqli_error($conn));
        }


   }

        mysqli_close($conn);

function shellprint($string)
{
    echo($string . "\n");
}

?>
