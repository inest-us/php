<?php
	echo "example 6-10 <br />";
	$products = array(
		'paper' => array(
			'copier' => "Copier & Multipurpose",
			'inkjet' => "Inkjet Printer",
			'laser'  => "Laser Printer",
			'photo'  => "Photographic Paper"),

		'pens' => array(
			'ball'   => "Ball Point",
			'hilite' => "Highlighters",
			'marker' => "Markers"),

		'misc' => array(
			'tape'   => "Sticky Tape",
			'glue'   => "Adhesives",
			'clips'  => "Paperclips") );

	echo "<pre>";
	foreach ($products as $section => $items) {
		//$items is a row in the 2D array
		foreach ($items as $key => $value) {
			echo "$section:\t$key\t($value)<br />";
		}
	}
		
	echo "</pre>";
?>
