<?php
	echo "example 6-5 <br />";

	$p1 = array("Copier", "Inkjet", "Laser", "Photo");

	echo "p1 element: " . $p1[2] . "<br />";

	$p2 = array('copier' => "Copier & Multipurpose",
				'inkjet' => "Inkjet Printer",
				'laser'  => "Laser Printer",
				'photo'  => "Photographic Paper");

	echo "p2 element: " . $p2['inkjet'] . "<br />";
	
	echo $p1['inkjet']; //undefined index
	echo $p2['3']; //undefine offset
?>
