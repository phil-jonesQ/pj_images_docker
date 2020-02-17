<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Here within is a collection of my best photographic images. The images may be licensed for use, sometimes free, but I need to be contacted where we can agree on terms. Once agreed I can issue you the licence and full res, non water-marked image. Thanks Phil Jones feb 2017">
<meta name="google-site-verification" content="9qkiXdZmHshyJZ0Gt7QBehksGf9PMz-FpCzbL9QLIq8" />
    <title>Philip R Jones Images</title>	
	<link href="/css/progress.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="./css/slide.css" rel="stylesheet" type="text/css">
	<link href="./css/navbar.css" rel="stylesheet" type="text/css">
	<script src="./js/pjViewCount.js"></script>
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
                <?php
		//Default
		$category_call="Home";

                $category_call=$_GET["category"];
		echo '<li><a href="show.php?category=Home">Home</a></li>';
                echo '<li><a href="gallery.php">Gallery</a></li>';
                if ($category_call == "Macro") {
                  echo '<li><a href="show.php?category=Night">Portfolio Night</a></li>';
                }
                elseif ($category_call == "Night") {
                  echo '<li><a href="show.php?category=Bokeh">Portfolio Bokeh</a></li>';
                } 
                else {
                  echo '<li><a href="show.php?category=Macro">Portfolio Macro</a></li>';
                }
                if ($category_call == "Portraits") {            
                  echo '<li><a href="show.php?category=Graphics">Portfolio Graphics</a></li>';
                }
                else {
                  echo '<li><a href="show.php?category=Portraits">Portfolio Portraits</a></li>';
                }           
                if ($category_call == "Landscape") {            
                  echo '<li><a href="show.php?category=Composite">Portfolio Composite</a></li>';
                }
                else {
                  echo '<li><a href="show.php?category=Landscape">Portfolio Landscape</a></li>';
                }
                echo '<li><a href="about.html">About</a></li>';
                echo '<li><a href="contact.html">Contact Me</a></li>';
                ?>
            </ul>
        </div>
    </div>
  </nav>
 </div>
 <br>  
<script src="/js/pace.js"></script>
    <div class="slideshow-container">
    	<?php
    	//Set category on how we were called
    	$my_category=$_GET["category"];
    	$my_home="Home";
    	include_once 'includes/psl-config_pj-images.php';
	// Create connection
	$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
	// Check connection
	if (!$conn) {
    		die("Connection failed: " . mysqli_connect_error());
	}
	
	// get results from database
	// All images that are defined properly and order by their rank
	
	//$query1="select * from assets where imageTitle != 'Image Not Defined' and SUBSTRING_INDEX(imageSize,'x',-1) < '5000' and category = '$my_category' and pjRank > 89 order by rand() LIMIT 8";
	//$query2="select * from assets where imageTitle != 'Image Not Defined' and SUBSTRING_INDEX(imageSize,'x',-1) < '5000' and category = '$my_category' and pjRank > 60 and pjRank < 90 order by rand() LIMIT 8;";
	
	$query1="select * from assets where imageTitle != 'Image Not Defined' and category = '$my_category' and pjRank > 60 order by rand() LIMIT 8";
	$query2="select * from assets where imageTitle != 'Image Not Defined' and category = '$my_category' order by pjRank desc LIMIT 8";
	
	$a=array($query1,$query2);
	
	$selector=$a[array_rand($a)];
	
	// Un comment to Debug randomizer algorithm
	//echo $selector;
	// Home page is just the eight current top ranked images.
	
	if ($my_category == $my_home){
	
	   $selector="select * from assets where imageTitle != 'Image Not Defined' and category != 'Portraits' and pjRank > 92 order by rand() LIMIT 8";
	   
	}

	$sql="select filename,imageTitle from assets where imageTitle != 'Image Not Defined' and category = '$my_category' order by pjRank desc LIMIT 8";
	$result = mysqli_query($conn, $selector);
	
	$counter=1;
	while($row = $result->fetch_assoc()) {
	    echo '<div class="imageContainer'. $counter . '">';
            echo '<div class="mySlides fade">';
            echo '<div class="numbertext">' .$counter . '/8</div>';
            echo '<img src="/assets/' . $row['filename'] . '" class="img-responsive margin" style="display: block; margin: auto;max-width:100%; height:auto;max-height:60%;max-height:60vh;" alt="">';
            //echo '<div class="text">' . $row['imageTitle'] . '</div>';
            echo '<script>$("div.imageContainer'. $counter . '").mouseenter(function(){loadXMLDoc(' . $row['id'] . ');});</script>';
	    echo '<a class="text" onClick="loadXMLDoc(' . $row['id'] . ')" href="contact.html?' . rawurlencode($row['imageTitle']) . '">' . $row['imageTitle'] . '</a>';
            echo '</div>';
            echo '</div>';
        $counter++;
        }
        mysqli_close($conn);
        ?>
     <div class="nextprev" style="display: none;">	
     <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
     <a class="next" onclick="plusSlides(1)">&#10095;</a>
     </div>       
   </div>
  <div class="followme" style="display: none;">
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
        <span class="dot" onclick="currentSlide(7)"></span>
        <span class="dot" onclick="currentSlide(8)"></span>
    </div>
     <div style="text-align:center">
        <a href="https://twitter.com/phil_jones" class="twitter-follow-button" data-show-count="false">Follow @phil_jones</a>
        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        <a href="http://www.flickriver.com/photos/pj_photos_/popular-interesting/">
          <img src="./assets/flickr-icon.png" style="margin-bottom: 12px;" alt="Philip R Jones on Flickr" title="Philip R Jones on Flickr"/></a>
        <a href="https://www.facebook.com/phil.jones.988711">
          <img src="./assets/social_facebook_box_blue_pj.png" style="margin-bottom: 12px;" alt="Phil Jones on Facebook" title="Phil Jones on Facebook"/></a>
    </div>
  </div>
<br>
<script type="text/javascript" >$(window).load(function() {
    $('.followme').show(); //show .container and .btn
    $('.nextprev').show(); //next previous buttons
     });
</script>
<script src="./js/slideShow.js" type="text/javascript"></script>
</body>
</html>
