<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    $stm = $pdo->query("SELECT * FROM countries");

    $rows = $stm->fetchAll(PDO::FETCH_NUM);
    foreach($rows as $row) {
        echo "$row[0] $row[1] $row[2] <br />";
    }
?>