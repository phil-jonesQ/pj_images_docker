<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Here within is a collection of my best photographic images. The images may be licensed for use, sometimes free, but I need to be contacted where we can agree on terms. Once agreed I can issue you the licence and full res, non water-marked image. Thanks Phil Jones feb 2017">
    <title>Philip R Jones Images</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="./css/gallery.css" rel="stylesheet" type="text/css">
	<link href="./css/navbar.css" rel="stylesheet" type="text/css">
	<link href="./css/sorter.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery.lazyload.js"></script>
	<script src="./js/pjViewCount.js"></script>
	<script src="./js/sorter.js"></script>
	<script src="./js/search.js"></script>
	<script src="./libraries/p5.js" type="text/javascript"></script>
	<script src="./libraries/p5.dom.js" type="text/javascript"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-93048639-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<div class="container-fluid bg-1 text-center">
 <nav class="navbar navbar-default navbar-fixed-top">
    <div id="Nav"><br>
        <div id="NavWrapper"><br>
            <ul>
		<li><a href="show.php?category=Home">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="show.php?category=Macro">Portfolio Macro</a></li>
                <li><a href="show.php?category=Portraits">Portfolio Portraits</a></li>
                <li><a href="show.php?category=Landscape">Portfolio Landscape</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact Me</a></li>
            </ul>
        </div>
    </div>
  </nav>
 </div>
<!--
<div class="search" > 
 <input placeholder="Search Me" id="box" type="text" />
</div> 
-->


<div class="sortselect" data-spy="affix">
<button onclick="myFunction()" class="dropbtn">Sort Gallery</button>
  <div id="myDropdown" class="sortselect-content">
  <?php

     //Set the default
     $sort_call="rank";

     $sort_call=$_GET['sort'];
     
     if ( $sort_call == "title" ) {
          echo '<a href="gallery.php?sort=titleRev">Name Z-A</a>';
     }
     else {
          echo '<a href="gallery.php?sort=title">Name A-Z</a>';
     }
     
     if ( $sort_call == "rank" ) {
          echo '<a href="gallery.php?sort=rankRev">Rank Low First</a>';
     }
     else {
          echo '<a href="gallery.php?sort=rank">Rank High First</a>';
     }
     if ( $sort_call == "views" ) {
          echo '<a href="gallery.php?sort=viewsRev">Views Low First</a>';
     } 
     else {
          echo '<a href="gallery.php?sort=views">Views High First</a>';
     }
     
     echo '<a href="gallery.php?sort=rand">Random</a>';
    ?>
  </div>
</div>

    <div class="slideshow-container">
     <br><br>
    	<?php
    	$sort=isset($_GET['sort']) ? $_GET['sort'] : 'rank';
    	// connect to the database
	include_once 'includes/psl-config_pj-images.php';
	// Create connection
	$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
	//mysql -upjadmin -h 172.17.0.2 -pnewpassword -Dpjimages
	//$conn = new mysqli('172.17.0.2', 'pjadmin', 'newpassword', 'pjimages');
	// Check connection
	if (!$conn) {
    		die("Connection failed: " . mysqli_connect_error());
	}
	
	//Random 
	if ($sort == "rand") {	
	     $query1="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=90 order by rand() desc";
	     $query2="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by rand()";
	     $query3="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by rand() desc";
	     $query4="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=50 order by rand() desc";
	
	     $a=array($query1,$query2,$query3,$query4);
	
	     $selector=$a[array_rand($a)];
	}
	
	if ($sort == "rank") {
	     $selector="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by a.pjRank desc";
	}
	
	if ($sort == "views") {
	     $selector="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by a.views desc";
	}
	
	if ($sort == "title") {
	      $selector="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by a.imageTitle";
	
	}
	
	if ($sort == "rankRev") {
	     $selector="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by a.pjRank";
	}
	
	if ($sort == "viewsRev") {
	     $selector="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by a.views";
	}

	if ($sort == "titleRev") {
	      $selector="select a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.pjRank <=150 order by a.imageTitle desc";
	
	}

	$result = $conn->query($selector);
	
	//image counter variable to ensure we have a unique div generated for each image container
	// this algorithm basically registers a view on click.
	// the jquery mouseenter function is used - generated by the below php code.
	$imgCounter = 0;
	
	if ($result->num_rows > 0) {
	    // output data of each row
    	  while($row = $result->fetch_assoc()) {
    	    echo '<div class="imageContainer'. $imgCounter . '">';
    	    echo '<div class="search_' . $row['imageTitle'] . '">';
	    echo '<div class="hovereffect">';
	    echo '<img class="lazy img-responsive" src="assets/spinner.gif" data-original="assets/' . $row['filename'] . '"  style="display: block; margin: auto;max-width:100%; height:auto;max-height:60%;max-height:60vh;padding:1px;border:thin solid white;" alt=""/>';
	    echo '<div class="overlay">';
	    echo '<h2>' . $row['imageTitle'] . '</h2>';
	    echo '<script>$("div.imageContainer'. $imgCounter . '").mouseenter(function(){loadXMLDoc(' . $row['mainID'] . ');});</script>';
	    echo '<a class="info" onClick="loadXMLDoc(' . $row['mainID'] . ')" href="contact.html?' . rawurlencode($row['imageTitle']) . '">More Info</a>';
	    echo '<br>';
            echo '<a class="info" onClick="loadXMLDoc(' . $row['mainID'] . ')" href="contact.html?'. rawurlencode($row['imageTitle']) . '">' . $row['description'] . '</a>';
            echo '</div>';
    	    echo '</div>';
	    echo '<a class="text" onClick="loadXMLDoc(' . $row['mainID'] . ')" href="contact.html?' . rawurlencode($row['imageTitle']) . '">' . $row['imageTitle'] . '</a>';
	    echo '<div class="dataText"><div class="dataTextdata">Focal Length: ' . $row['focalLength'] . ' Views: ' . $row['views'] . ' Image Rank: ' . $row['pjRank'] .'</div></div>';
	    echo '<br><br>';
	    echo '</div>';
	    echo '</div>';
	    $imgCounter++;
	  }
	 	} else {
	   	    echo "0 results";
		}
	mysqli_close($conn);
	?>
		
	<script type="text/javascript">
  	  $(function() {
     	  $("img.lazy").lazyload({
             effect : "fadeIn"
             });
          });
  	</script>	
    </div>
</body>
