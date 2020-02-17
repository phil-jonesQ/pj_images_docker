<?php

// Only load the page if we're auth'd

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
if(login_check($mysqli) != true) {

echo '<p>You are not authorized to access this page, please login.</p>';
echo "<p><a href=\"index.php\">Admin Home</a></p>";
die;
}

// Insert a new record to the db.

function renderForm($id, $filename, $title, $cameraMake, $cameraModel, $exposureProgram, $iso, $creationDate, $focalLength, $aperture, $imageSize, $shutterSpeed, $category, $isGetty, $isHDR, $isBW, $pjRank, $error)
{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>New Record</title>

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
<strong>Creation Date : *</strong> <input type="text" name="creationDate" value="2012-11-20 08:41:23"/><br/>
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
<strong>Is Getty : *</strong> <select id="Is Getty" name="isGetty"> <option value="0">false</option><option value="1">true</option>
</select><br/>
<strong>Is HDR : *</strong> <select id="Is HDR" name="isHDR"> <option value="0">false</option><option value="1">true</option>
</select><br/>
<strong>Is BW : *</strong> <select id="Is BW" name="isBW"> <option value="0">false</option><option value="1">true</option>
</select><br/>
<strong>Rank : *</strong> <input type="text" name="pjRank" value="<?php echo $pjRank; ?>"/><br/>

<p>* Required</p>

<input type="submit" name="submit" value="Submit">

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



// check that the fields are filed in

if ($filename == '' || $title == '' || $pjRank == '' || $creationDate == '' || $aperture == '' || $iso == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $filename, $title, $cameraMake, $cameraModel, $exposureProgram, $iso, $creationDate, $focalLength, $aperture, $imageSize, $shutterSpeed, $category, $isGetty, $isHDR, $isBW, $pjRank, $error);

}

else

{

// save the data to the database
//echo "</p>INSERT INTO assets VALUES (INSERT INTO assets VALUES (0,$filename, $title, $cameraMake, $cameraModel, $exposureProgram, $iso, $creationDate, $focalLength, $aperture, $imageSize, $shutterSpeed, $category, $isGetty, $isHDR, $isBW, $pjRank,0,now()))</p>";

mysql_query("INSERT INTO assets VALUES (0, '$title', '$filename', '$cameraMake', '$cameraModel', '$exposureProgram', '$iso', '$creationDate', '$focalLength', '$aperture', '$imageSize', '$shutterSpeed', '$category', '$isGetty', '$isHDR', '$isBW', '$pjRank',0,now())")
or die(mysql_error());

// once saved, redirect back to the view page

header("Location: view.php");

}

}
else
// if the form hasn't been submitted, display the form
{

renderForm('', '', '','', '', '', '', '', '','', '', '', '', '', '', '', '', '');

}

?>