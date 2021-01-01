<?php
    $Today = date("l F d, Y");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Example 1.5</title>
</head>
<body>
    <h2>Today is:</h2>
    <?php
        print("<h2>$Today</h2><br>");
        $YourName = $_POST["YourName"];
        $CostOfLunch = $_POST["CostOfLunch"];
        $DaysBuyingLunch = $_POST["DaysBuyingLunch"];

        print("$YourName, you will spend ");
        print($CostOfLunch * $DaysBuyingLunch);
        print(" dollars this week.");
    ?>
</body>
</html>