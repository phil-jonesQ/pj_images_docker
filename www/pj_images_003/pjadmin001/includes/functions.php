<?php
	
	// Common functions
	
	function checker($input) {
		return htmlentities($input,ENT_QUOTES,"UTF-8");
	}
	
	
	function getImage($fullPath) {
	
		if (isset($_GET['image'])) 
		
		{
			if ($fullPath == true) 
			{
				$img_to_load="/assets/".checker($_GET['image']);
			}
			else
			{
				$img_to_load=checker($_GET['image']);
			}
		} 
		else
		{
			if ($fullPath == true) 
			{
				$img_to_load="/assets/".IMAGE_OF_THE_DAY;
			}
			else 
			{
				$img_to_load=IMAGE_OF_THE_DAY;
			}
		}
		return $img_to_load;		
	
	}
	
	function getID() {
	
		if (isset($_GET['id'])) {
						$img_id=checker($_GET['id']);
				} 
				else
					{
						$img_id=IMAGE_OF_THE_DAY_ID;
					}
		return $img_id;
	
	}
	

?>