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

// connect to the database

include('php/connect-db.php');


// check if the 'id' variable is set in URL, and check that it is valid

if (isset($_GET['id']) && is_numeric($_GET['id']))

{

// get id value

$id = $_GET['id'];

// delete the entry

$result = mysql_query("DELETE FROM assets WHERE id=$id")

or die(mysql_error());



// redirect back to the view page

header("Location: view.php");

}

else

// if id isn't set, or isn't valid, redirect back to view page

{

header("Location: view.php");

}



?>
