<html>
<head>
   <title>recursion</title>
</head>
<body>
    <?php
        $num = $_POST['num'];
        function factorial($num) {
            if ($num <= 1) {
                return 1;
            } else {
                return $num * factorial($num - 1);
            }
        }
        echo "The factorial of " . $num . " is " . (factorial($num));
    ?>
</body>
</html>
