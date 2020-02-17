<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>View Records</title>
</head>

<body>

<?php

/*

VIEW-PAGINATED.PHP

Displays all data from 'players' table

This is a modified version of view.php that includes pagination

*/

// connect to the database

include('php/connect-db.php');

// number of results to show per page

$per_page = 30;
// figure out the total pages in the database

$result = mysql_query("SELECT * FROM assets order by timestamp desc");

$total_results = mysql_num_rows($result);

$total_pages = ceil($total_results / $per_page);

// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)

if (isset($_GET['page']) && is_numeric($_GET['page']))

{

$show_page = $_GET['page'];

// make sure the $show_page value is valid

if ($show_page > 0 && $show_page <= $total_pages)

{

$start = ($show_page -1) * $per_page;

$end = $start + $per_page;

}

else

{

// error - show first set of results

$start = 0;

$end = $per_page;

}

}

else

{

// if page isn't set, show first set of results

$start = 0;

$end = $per_page;

}

//Protecte from here

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
if(login_check($mysqli) == true) {


echo "<p><a href='new.php'>Add a new record</a> | <a href=\"index.php\">Admin Home</a></p>";

// display pagination

echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";

for ($i = 1; $i <= $total_pages; $i++)

{

echo "<a href='view-paginated.php?page=$i'>$i</a> ";

}

echo "</p>";



// display data in table

echo "<table border='1' cellpadding='10'>";

echo "<tr><th>File Name</th> <th>Image Title</th> <th>Preview</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table

for ($i = $start; $i < $end; $i++)

{

// make sure that PHP doesn't try to show results that don't exist

if ($i == $total_results) { break; }

// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . mysql_result($result, $i, 'filename') . '</td>';

echo '<td>' . mysql_result($result, $i, 'category') . '</td>';

echo '<td><img src="assets/' . mysql_result($result, $i, 'filename') . '" width=100px height=90px/>';

echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'id') . '">Edit</a></td>';

echo '<td><a href="delete.php?id=' . mysql_result($result, $i, 'id') . '">Delete</a></td>';

echo "</tr>";


}

// close table>

echo "</table>";

echo "<p><a href=\"new.php\">Add a new record</a></p>";
echo "<p><a href=\"index.php\">Admin Home</a></p>";

} else {
        echo 'You are not authorized to access this page, please login.';
	echo "<p><a href=\"index.php\">Admin Home</a></p>";
}


?>

</body>

</html>
