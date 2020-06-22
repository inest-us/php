<!DOCTYPE html>
<html>
    <head>
        <title>freight</title>
    </head>
    <body>
        <table border="0" cellpadding="3">
            <tr>
                <th bgcolor="#CCCCCC" align="center">Distance</th>
                <th bgcolor="#CCCCCC" align="center">Cost</th>
            </tr>
            <?php
                $distance = 50;
                while ($distance <= 250) {
                    echo "<tr>";
                    echo "<td align=\"right\">" . $distance . "</td>";
                    echo "<td align=\"right\">" . ($distance / 10) . "</td>";
                    echo "</tr>";
                    $distance += 50;
                }
            ?>
        </table>
    </body>
</html>
