<!DOCTYPE html>
<html>
<head>
    <title>Example 2.2</title>
</head>
<body>
    <?php
        function printCity($cityName) {
            print("The city is $cityName. <br />");
        }

        function california() {
            $capital = "Sacramento";
            printCity($capital);
        }

        function utah() {
            $capital = "Salt Lake City";
            printCity($capital);
        }

        function nation() {
            global $capital;
            printCity($capital);
        }

        $capital = "Washington DC";
        nation();
        california();
        utah();
        nation();
    ?>
</body>
</html>