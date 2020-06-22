<!DOCTYPE html>
<html>
<head>
  <title>Bob’s Auto Parts - Order Results</title>
</head>
<body>
    <h1>Bob’s Auto Parts</h1>
    <h2>Order Results</h2>
    <?php
        // create short variable names
        $tireqty = $_POST['tireqty'];
        $oilqty = $_POST['oilqty'];
        $sparkqty = $_POST['sparkqty'];
        $address = $_POST['address'];
        $totalqty = 0;
        $totalqty = $tireqty + $oilqty + $sparkqty;
        $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
        $date = date('H:i, jS F Y');
        echo "<p>Order processed at ";
        echo $date;
        echo "</p>";
        if ($totalqty == 0) {
            echo '<p style="color:red;">';
            echo "You did not order anything on the previous page!<br />";
            echo '</p>';
        } else {
            echo '<p>Your order is as follows: </p>';
            if ($tireqty > 0) {
                echo $tireqty.' tires<br />';
            }
            if ($oilqty) {
                echo $oilqty.' bottles of oil<br />';
            }
            if ($sparkqty > 0) {
                echo $sparkqty.' spark plugs<br />';
            }
            echo "Items ordered: ".$totalqty."<br />";
            $totalamount = 0.00; 
            define('TIREPRICE', 100);
            define('OILPRICE', 10);
            define('SPARKPRICE', 4); 
            $totalamount = $tireqty * TIREPRICE
                + $oilqty * OILPRICE
                + $sparkqty * SPARKPRICE;
            echo "Subtotal: $" . number_format($totalamount, 2) . "<br />"; 
            $taxrate = 0.10;
            $totalamount = $totalamount * (1 + $taxrate);
            echo "Total including tax: $" . number_format($totalamount, 2) . "<br />";
            echo "<p>Address to ship to is ".$address."</p>";
            $outputstring = $date."\t".$tireqty." tires \t".$oilqty." oil\t"
                    .$sparkqty." spark plugs\t\$".$totalamount
                    ."\t". $address."\n";
            // open file for appending
            @$fp = fopen("$DOCUMENT_ROOT/php101/c01/orders.txt", 'ab');
            flock($fp, LOCK_EX);
            if (!$fp) {
                echo "<p><strong> Your order could not be processed at this time.
                        Please try again later.</strong></p></body></html>";
                exit;
            }
            fwrite($fp, $outputstring, strlen($outputstring));
            flock($fp, LOCK_UN);
            fclose($fp);
            echo "<p>Order written.</p>";
        }
    ?>
</body>
</html>