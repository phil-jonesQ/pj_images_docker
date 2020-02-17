<!DOCTYPE html>


<?php include 'includes/config.php';?>
<?php include 'includes/functions.php';?>
<?php
function deleteCookie($cookie_name) 
{
	// set the expiration date to one hour ago
	setcookie($cookie_name, "", time() - 3600);
}
$cookie_name = "BeenBefore";
$cookie_value = "Visited";
//Only set the cookie if we're not been returned a log_out GET
if (!isset($_GET['log_out']))
{
setcookie( $cookie_name, $cookie_value, time()+60*30, '/', 'pj-images.com', false,true);
}

if(!isset($_COOKIE[$cookie_name])) 
{
   	//echo "Cookie named '" . $cookie_name . "' is not set!";
   	$logged_in=false;
} 
else
{
    	//echo "Cookie '" . $cookie_name . "' is set!<br>";
    	//echo "Value is: " . $_COOKIE[$cookie_name];
    	$logged_in=true;
}

if (isset($_GET['log_out']))
{
	$log_out_state=$_GET['log_out'];
}
		
if ($log_out_state == true) {

	$logged_in=false;
	deleteCookie($cookie_name);
}				
			
			
					
?>

<html>

<head>
	
	<title>PJ Images Admin Util <?=VERSION;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- My Styles-->
	<link rel="stylesheet" href="<?=DOCROOT;?>/css/main.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/css/news.css">
	<script src="/js/news.js"></script>
	
</head>
<body>

<!--
<div class="ticker pure-g-r">
  <div class="pure-u-3-4">
    <ul class="lines">
      <li id="ArticleTitle0"><a href=#></a></li>
      <li id="ArticleTitle1"></li>
      <li id="ArticleTitle2"></li>
      <li id="ArticleTitle3"></li>
      <li id="ArticleTitle4"></li>
      <li id="ArticleTitle5"></li>
      <li id="ArticleTitle6"></li>
      <li id="ArticleTitle7"></li>
      <li id="ArticleTitle8"></li>
      <li id="ArticleTitle9"></li>
      <li id="ArticleTitle10"></li>
      <li id="ArticleTitle11"></li>
      <li id="ArticleTitle12"></li>
      <li id="ArticleTitle13"></li>
      <li id="ArticleTitle14"></li>
    </ul>
  </div>
</div>--> 
	<?php
		$sql = "SELECT * from categories";
		$result = mysqli_query($conn, $sql);
	?>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?=DOCROOT;?>/index.php">PJ Images Admin Tool <?=VERSION;?></a>
			<!--**************************Handle the dynamic nav bar items******************************* -->
			<?php while ($category = mysqli_fetch_assoc($result)) : ?>
			<ul class="nav navbar-nav">
				
					
					<li class="dropdown">
					
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$category['name'];?><span class="caret"></span></button>
						<ul class="dropdown-menu scrollable-menu" role = "menu" >
							<?php
								$category_id = $category['id'];
								//$sql2 = "SELECT * from assets where category_id=$category_id LIMIT 100";
								$sql2 = "SELECT a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,
								ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description 
								AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.category_id=$category_id ORDER BY a.imageTitle";
								$result2 = mysqli_query($conn, $sql2);
								while ($asset = mysqli_fetch_assoc($result2)) : ?>
									<li><a href="<?=DOCROOT;?>/index.php?image=<?=$asset['filename']."&id=".$asset['mainID']?>"><?=$asset['imageTitle'];?></a></li>
										
						<?php endwhile; ?>
					</ul>
					
					
					</li>
			</ul>
			<?php endwhile; ?>
			<!--**************************Handle the right nav bar items******************************* -->
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><small><span class="glyphicon glyphicon-cog btn btn-xs"></span></small></a></li>
      				<li><a href="#"><small><span class="glyphicon glyphicon-user"></span></small> Sign Up</a></li>
      				<?php
      				//echo "Cookie '" . $cookie_name . "' is set!<br>";
    				//echo "Value is: " . $_COOKIE[$cookie_name];
      				if (! $logged_in){
      					echo '<li><a href="' . DOCROOT . '/index.php"><smal><span class="glyphicon glyphicon-log-in"></span></small> Login</a></li>';
      				} else {
      					
      					$myAsset=getImage();
      					$myID=getID();
      					echo '<li><a href="' . DOCROOT . '/index.php?image=' . $myAsset . '&id=' . $myID . '&log_out=true"><smal><span class="glyphicon glyphicon-log-out"></span></small> Logout</a></li>';
      				}
      				?>
      				
    			</ul>
		</div>
	</nav>
	<div class="mainPage-container">	
	<!--
		#############################
		Image presentation section
		#############################-->
		
		<?php 	
			//Fire a simple function to get the image data sent to us in our GET var "image" pass in true when we want the full path
			$img_to_load=getImage(true);	
		?>
		
		<?php
		
			//Generate Image Size Var
			$myImage = DOMAIN_URL . DOCROOT . $img_to_load;
			//list($width, $height) = getjpegsize("http://www.pj-images.com/pjadmin001/assets/CreepyWoodsFinal_v2.3_1_of_1.jpg");
			list($width, $height, $type, $attr) = getimagesize($myImage);
	
		?>
		
		<div>
			

			<!-- now display the image -->
			<!--<img class="img-responsive" src="<?=DOCROOT.$img_to_load;?>" style="display: block; margin: auto;max-width:100%; height:auto;max-height:70%;max-height:70vh;" width="90%">-->
			<img id="picFade" class="img-responsive" src="<?=DOCROOT;?>/assets/Blank2.png" style="display: block; margin: auto;max-width:<?=$width;?>px; height:auto;max-height:70%;max-height:70vh;" >
		</div>
		<script>
				var image = document.images[0];
				var downloadingImage = new Image();
				downloadingImage.onload = function(){
						$('#picFade').hide();
						image.src = this.src;
						$('#picFade').fadeIn(1500);   
				};
				
				downloadingImage.src = "<?=DOCROOT.$img_to_load;?>";
				
		</script>	
		
			
			<?php
			//Get the id of the image passed in from drop downs - for image of the day determine the id from our config file
				$img_id=getID();
			?>
			
			<?php
				
				$sql3 = "SELECT a.id mainID,a.filename,a.imageTitle,a.views,a.pjRank,a.focalLength,ad.id,ad.assets_id,ad.description from assets AS a RIGHT JOIN asset_description AS ad ON a.id=ad.assets_id where a.imageTitle != 'Image Not Defined' and a.id=$img_id";
				$result3 = mysqli_query($conn, $sql3);
				$asset_display = mysqli_fetch_assoc($result3);
			?>
		<!-- Modal section built on the fly based from our database - we use asset id from previous query-->
		<button type="button" class="btn btn-info btn-lg center-block btn-space" data-toggle="modal" data-target="#myModal">Details</button>
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><?=$asset_display['imageTitle'];?></h4>	
						</div>
						<div class="modal-body">
							<p><?=$asset_display['description'];?></p>
							<p class="text-muted small">Views:<?=$asset_display['views']." Focal Length:".$asset_display['focalLength']." Image Size: " . $width . "x" . $height ;?></p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default center-block" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
								
	</div>
		
	<footer class="navbar-default navbar-fixed-bottom text-muted"
		<?php include 'includes/footer.php';?>
	</footer>

</body>
</html>
