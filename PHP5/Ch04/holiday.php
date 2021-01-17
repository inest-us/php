<html>
<head>
	<title>holiday</title>
</head>
<body>
	<?php
        $price = 500;
        $starmodifier = 1;
        $citymodifier = 1;
        $destination = $_POST['destination'];
        $destgrade = $_POST['destination'] . $_POST['grade'];
        switch($destgrade) {
            case "Barcelonathree":
                $citymodifier = 2;
                $price = $price * $citymodifier; 
                echo "The cost for a week in $destination is $price";
                break;
            case "Barcelonafour":
                $citymodifier = 2;
                $starmodifier = 2;
                $price = $price * $citymodifier * $starmodifier;
                echo "The cost for a week in $destination is $price";
                break;
            case "Viennathree":
                $citymodifier = 3.5;
                $price = $price * $citymodifier;
                echo "The cost for a week in $destination is $price";
                break;
            case "Viennafour":
                $citymodifier = 3.5;
                $starmodifier = 2;
                $price = $price * $citymodifier * $starmodifier;
                echo "The cost for a week in $destination is $price";
                break;
            case "Praguethree": 
                $price = $price * $citymodifier;
                echo "The cost for a week in $destination is $price";
                break;
            case "Praguefour": 
                $starmodifier = 2;
                $price = $price * $citymodifier * $starmodifier;
                echo "The cost for a week in $destination is $price";
                break;
            default:
                echo ("Go back and do it again");
                break; 
        }
	?>
</body>
</html>
