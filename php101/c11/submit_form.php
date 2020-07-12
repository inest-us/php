<?php
    switch ($_POST['gender']) {
        case "Male":
        case "Female":
        case "Other":
            echo "<p align=\"center\">Congratulations!
                    You are: ".$_POST['gender']. ".</p>";
            break;
        default:
            echo "<p align=\"center\">
                <span style=\"color: red;\">WARNING:</span>
                Invalid input value for gender specified.</p>";
            break;
    }
?>