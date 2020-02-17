<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>View Records</title>
<script src="./libraries/imageScale.js" type="text/javascript"></script>


</head>

<body>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script>
        $(document).ready(function(){
        $('#box').keyup(function () {
            var valThis = this.value.toLowerCase();
            var re = new RegExp(valThis,"ig");

            $('a#tElement').each(function () {
                var text  = $(this).text(),
                textL = text.toLowerCase(),
                htmlR = text.replace(re,function (match) { return '<b>'+match+'</b>'; });
                var str = $(this).attr('href');
                //console.log(str);
                //var id = str.match(/\d+$/);
                var id = str;
                //console.log('div#search'+id);
                if(textL.indexOf(valThis) >= 0){
                     $(this).html(htmlR).show();
                     $('div#search'+id).hide();
                     //console.log('div#search'+id);
                }else{
                     $('div#search'+id).hide();
                     console.log('div#search'+id);
                }
            });
        })});
</script>
        
        <div style="width:800px; float:left;">
        <input placeholder="Search Me" id="box" type="text" />
        </div>

<?php

/*

VIEW.PHP

Displays all data from 'players' table

*/



// connect to the database

include('php/connect-db.php');


// get results from database

$result = mysql_query("SELECT * FROM assets order by category")

or die(mysql_error());
//Protected from here
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start(); 
if(login_check($mysqli) == true) {


// display data in table
echo '<br>';
echo "<p><a href='new.php'>Add a new record</a> | <a href=\"index.php\">Admin Home</a></p>";

echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";



echo "<table border='1' cellpadding='10'>";

echo "<tr><th>File Name</th> <th>Category</th> <th>Preview</th> <th></th> <th></th></tr>";

$counter=0;
// loop through results of database query, displaying them in the table

while($row = mysql_fetch_array( $result )) {



// echo out the contents of each row into a table
echo '<div id="search'.$row['filename'] . '">';
echo "<tr>";
//echo '<div id="tElement">';
echo '<td><a id="tElement" href="' .$row['filename']. '"> ' . $row['filename'] . '</a></td>';

echo '<td>' . $row['category'] . '</td>';

echo '<td><img src="assets/' . $row['filename'] . '" width=100px height=90px/>';
//echo '<div style="width: 100px; height: 100px; border: thick solid #666666; overflow: hidden; position: relative;"><td><img src="assets/' . $row['filename'] . '" style="position: absolute;" onload="OnImageLoad(event);"/>';
echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';

echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';

//echo '</div>';
echo "</tr>";
echo '</div>';
$counter ++;
}

//<div style="width: 150px; height: 150px; border: thick solid #666666; overflow: hidden; position: relative;">
//    <img src="tanahlog.jpg" style="position: absolute;" onload="OnImageLoad(event);"/>
//</div>


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
