<HTML>
	<HEAD>
		<SCRIPT LANGUAGE="Javascript" SRC="TreeMenu.js"></SCRIPT>
	</HEAD>
	<BODY>
		<?php
			require_once('HTML/TreeMenu.php');
			require_once('xmlhtmltree.phpm');			
	    $objXMLTree = new XMLHTMLTree("treemenutest.xml");
	    $objXMLTree->GenerateHandOffs();
	    $objXMLTree->ParseXML();
	    $objTreeMenu = $objXMLTree->GetTreeHandoff();
		?>
		<H1>Tree Menu Test</H1>
		<HR>
		<?php
			$objTreeMenu->printMenu();
		?>
	</BODY>
</HTML>