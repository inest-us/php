<html>
<head>
    <title>Loan</title>
</head>
<body>
    <?php
        $duration = 0; 
        $loan = $_POST['loan'];
        switch ($loan) {
            case "1000";
                $interest = 5;
                break;
            case "5000";
                $interest = 6.5;
                break;
            case "10000";
                $interest = 8;
                break;
            default:
                echo "You didn't enter a loan package!<hr>";
                exit;
        }
        while ($loan > 0) {
            $duration = $duration + 1;
            $monthly = $_POST['month'] - ($loan * $interest / 100);
            if ($monthly <= 0) { 
                echo "You need larger repayments to pay off your loan!<hr>";
                exit;
            }
            $loan = $loan - $monthly;	
        }
        echo "This would take you $duration months to pay this off at the interest rate of $interest percent.<hr>";
    ?>
</body>
</html>
