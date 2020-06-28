<?php
    //create short variable names
    $name = addslashes(trim($_POST['name']));
    $email = addslashes(trim($_POST['email']));
    $feedback = addslashes(trim($_POST['feedback']));
    $email_array = explode('@', $email);

    if (!eregi('^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $email)) {
        echo "<p>That is not a valid email address.</p>".
                "<p>Please return to the previous page and try again.</p>";
        exit;
    }
    
    //set up some static information
    if (strtolower($email_array[1]) == "bigcustomer.com") {
        $toaddress = "bob@example.com";
    } else {
        $toaddress = "feedback@example.com";
        if (strstr($feedback, 'shop')) {
            $toaddress = "retail@example.com";
        } else if (strstr($feedback, 'delivery')) {
            $toaddress = "fulfillment@example.com";
        } else if (strstr($feedback, 'bill')) {
            $toaddress = "account@example.com";
        }
    }
    $subject = "Feedback from web site";
    $mailcontent = "Customer name: ".$name."\n".
                "Customer email: ".$email."\n".
                "Customer comments:\n".$feedback."\n";
    $fromaddress = "From: webserver@example.com";
    //invoke mail() function to send mail
    mail($toaddress, $subject, $mailcontent, $fromaddress);
?>
<html>
<head>
    <title>Bob’s Auto Parts - Feedback Submitted</title>
</head>
<body>
    <h1>Feedback submitted</h1>
    <p>Your feedback (shown below) has been sent.</p>
    <p>
        <?php
            echo nl2br($mailcontent);
        ?>
    </p>
</body>
</html>
