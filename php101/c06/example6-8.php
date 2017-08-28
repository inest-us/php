<?php
	echo "example 6-8 <br />";
	$paper = array('copier' => "Copier & Multipurpose",
				'inkjet' => "Inkjet Printer",
				'laser'  => "Laser Printer",
				'photo'  => "Photographic Paper");

	/*
	The list function takes an array as its argument 
	(in this case the key and value pair returned by function each) 
	and then assigns the values of the array to the variables listed
	*/			
				
	while (list($item, $description) = each($paper)) {
		echo "$item: $description<br>";
	}
?>
