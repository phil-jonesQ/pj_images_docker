<?php

/*
EDIT.PHP
Allows user to edit specific entry in database
*/

// Only load the page if we're auth'd

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
if(login_check($mysqli) != true) {

echo '<p>You are not authorized to access this page, please login.</p>';
echo "<p><a href=\"index.php\">Admin Home</a></p>";
die;
}

// creates the edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($id, $filename, $title, $cameraMake, $cameraModel, $exposureProgram, $iso, $creationDate, $focalLength, $aperture, $imageSize, $shutterSpeed, $category, $isGetty, $isHDR, $isBW, $pjRank, $description, $error)
{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

//Map Categories
$cat0="Bokeh";
$cat1="Composite";
$cat2="Graphics";
$cat3="Landscape";
$cat4="Macro";
$cat5="Night";
$cat6="Portraits";

?>

<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>

<p><strong>ID:</strong> <?php echo $id; ?></p>

<strong>File Name: *</strong> <input type="text" name="filename" value="<?php echo $filename; ?>"/><br/>
<strong>Title Name: *</strong> <input type="text" name="title" value="<?php echo $title; ?>"/><br/>
<strong>Camera Make : *</strong> <input type="text" name="cameraMake" value="<?php echo $cameraMake; ?>"/><br/>
<strong>Camera Model : *</strong> <input type="text" name="cameraModel" value="<?php echo $cameraModel; ?>"/><br/>
<strong>Exposure Program : *</strong> <input type="text" name="exposureProgram" value="<?php echo $exposureProgram; ?>"/><br/>
<strong>ISO : *</strong> <input type="text" name="iso" value="<?php echo $iso; ?>"/><br/>
<strong>Creation Date : *</strong> <input type="text" name="creationDate" value="<?php echo $creationDate; ?>"/><br/>
<strong>Focal Length : *</strong> <input type="text" name="focalLength" value="<?php echo $focalLength; ?>"/><br/>
<strong>Aperture : *</strong> <input type="text" name="aperture" value="<?php echo $aperture; ?>"/><br/>
<strong>Image Size : *</strong> <input type="text" name="imageSize" value="<?php echo $imageSize; ?>"/><br/>
<strong>Shutter Speed : *</strong> <input type="text" name="shutterSpeed" value="<?php echo $shutterSpeed; ?>"/><br/>
<strong>Category : *</strong> <select id="Category" name="category"> <option value="<?php echo $category; ?> "><?php echo $category; ?></option>
<?php if ($category != $cat0) {echo "<option value=$cat0>$cat0</option>";} ?>
<?php if ($category != $cat1) {echo "<option value=$cat1>$cat1</option>";} ?>
<?php if ($category != $cat2) {echo "<option value=$cat2>$cat2</option>";} ?>
<?php if ($category != $cat3) {echo "<option value=$cat3>$cat3</option>";} ?>
<?php if ($category != $cat4) {echo "<option value=$cat4>$cat4</option>";} ?>
<?php if ($category != $cat5) {echo "<option value=$cat5>$cat5</option>";} ?>
<?php if ($category != $cat6) {echo "<option value=$cat6>$cat6</option>";} ?>
</select><br/>
<strong>Is Getty : *</strong> <select id="Is Getty" name="isGetty"> <option value="<?php echo $isGetty; ?> "><?php if ($isGetty==1) {echo 'true';}else{echo 'false';} ?></option>
<?php if ($isGetty==1) {echo '<option value="0">false</option>';} ?>
<?php if ($isGetty==0) {echo '<option value="1">true</option>';} ?>
</select><br/>
<strong>Is HDR : *</strong> <select id="Is HDR" name="isHDR"> <option value="<?php echo $isHDR; ?> "><?php if ($isHDR==1) {echo 'true';}else{echo 'false';} ?></option>
<?php if ($isHDR==1) {echo '<option value="0">false</option>';} ?>
<?php if ($isHDR==0) {echo '<option value="1">true</option>';} ?>
</select><br/>
<strong>Is BW : *</strong> <select id="Is BW" name="isBW"> <option value="<?php echo $isBW; ?> "><?php if ($isBW==1) {echo 'true';}else{echo 'false';} ?></option>
<?php if ($isBW==1) {echo '<option value="0">false</option>';} ?>
<?php if ($isBW==0) {echo '<option value="1">true</option>';} ?>
</select><br/>
<strong>Rank : *</strong> <input type="text" name="pjRank" value="<?php echo $pjRank; ?>"/><br/>
<strong>Description : *</strong> <textarea rows="4" cols="50" name="description"><?php echo $description; ?></textarea><br/>


<p>* Required</p>

<input type="submit" name="submit" value="Submit">

</div>


</form>

<br>
<div>
	<img src="assets/<?php echo $filename; ?>" width="50%" height="50%"/>
</div>

</body>

</html>

<?php

}


// connect to the database

include('php/connect-db.php');

// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];
$filename = mysql_real_escape_string(htmlspecialchars($_POST['filename']));
$title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
$cameraMake= mysql_real_escape_string(htmlspecialchars($_POST['cameraMake']));
$cameraModel = mysql_real_escape_string(htmlspecialchars($_POST['cameraModel']));
$exposureProgram = mysql_real_escape_string(htmlspecialchars($_POST['exposureProgram']));
$iso = mysql_real_escape_string(htmlspecialchars($_POST['iso']));
$creationDate = mysql_real_escape_string(htmlspecialchars($_POST['creationDate']));
$focalLength = mysql_real_escape_string(htmlspecialchars($_POST['focalLength']));
$aperture = mysql_real_escape_string(htmlspecialchars($_POST['aperture']));
$imageSize = mysql_real_escape_string(htmlspecialchars($_POST['imageSize']));
$shutterSpeed = mysql_real_escape_string(htmlspecialchars($_POST['shutterSpeed']));
$imageSize = mysql_real_escape_string(htmlspecialchars($_POST['imageSize']));
$category = mysql_real_escape_string(htmlspecialchars($_POST['category']));
$isGetty = mysql_real_escape_string(htmlspecialchars($_POST['isGetty']));
$isHDR = mysql_real_escape_string(htmlspecialchars($_POST['isHDR']));
$isBW = mysql_real_escape_string(htmlspecialchars($_POST['isBW']));
$pjRank = mysql_real_escape_string(htmlspecialchars($_POST['pjRank']));
$description = mysql_real_escape_string(htmlspecialchars($_POST['description']));



// check that the fields are filed in

if ($filename == '' || $title == '' || $pjRank == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $filename, $title, $cameraMake, $cameraModel, $exposureProgram, $iso, $creationDate, $focalLength, $aperture, $imageSize, $shutterSpeed, $category, $isGetty, $isHDR, $isBW, $pjRank, $description, $error);

}

else

{

// save the data to the database

mysql_query("UPDATE assets SET filename='$filename', imageTitle='$title', cameraMake='$cameraMake', cameraModel='$cameraModel',exposureProgram='$exposureProgram', iso='$iso', creationDate='$creationDate', focalLength='$focalLength', aperture='$aperture', imageSize='$imageSize', shutterSpeed='$shutterSpeed', category='$category', isGetty='$isGetty', isHDR='$isHDR', isBW='$isBW', pjRank='$pjRank', timestamp=now() WHERE id='$id'")
or die(mysql_error());

//echo "UPDATE asset_description set description='$description' WHERE id='$id'";
mysql_query("UPDATE asset_description set description='$description' WHERE assets_id='$id'")
or die(mysql_error());

// once saved, redirect back to the view page

header("Location: view.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM assets WHERE id=$id")
or die(mysql_error());

$result2 = mysql_query("SELECT * FROM asset_description where assets_id=$id")
or die(mysql_error());

$row = mysql_fetch_array($result);
$row2= mysql_fetch_array($result2);


// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$filename = $row['filename'];
$title = $row['imageTitle'];
$cameraMake= $row['cameraMake'];
$cameraModel = $row['cameraModel'];
$exposureProgram = $row['exposureProgram'];
$iso = $row['iso'];
$creationDate = $row['creationDate'];
$focalLength = $row['focalLength'];
$aperture = $row['aperture'];
$imageSize = $row['imageSize'];
$shutterSpeed = $row['shutterSpeed'];
$imageSize = $row['imageSize'];
$category = $row['category'];
$isGetty = $row['isGetty'];
$isHDR = $row['isHDR'];
$isBW = $row['isBW'];
$pjRank = $row['pjRank'];
$description = $row2['description'];


// show form

renderForm($id, $filename, $title, $cameraMake, $cameraModel, $exposureProgram, $iso, $creationDate, $focalLength, $aperture, $imageSize, $shutterSpeed, $category, $isGetty, $isHDR, $isBW, $pjRank, $description, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>
