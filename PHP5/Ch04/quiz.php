<html>
<head>
	<title>Quiz</title>
</head>
<body>
<?php
    if ($_POST['question1'] == "Lisbon") {
        echo "You are correct, $_POST[question1] is the right answer";
    } else {
        echo "You are incorrect, $_POST[question1] is not the right answer";
    }
?>
</body>
</html>
