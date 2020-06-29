<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    $stm = $pdo->query("SELECT * FROM countries");

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row) {
        echo "{$row['id']} {$row['name']} {$row['population']} <br />";
    }
?>