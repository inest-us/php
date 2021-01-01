<?php
	echo "example 6-6 <br />";

	$paper = array("Copier", "Inkjet", "Laser", "Photo");
	$j = 0;

	foreach ($paper as $item) {
		echo "$j: $item <br />";
		++$j;
	}
?>
