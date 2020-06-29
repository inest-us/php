<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    $id = 11;
    $stm = $pdo->prepare("SELECT * FROM countries WHERE id = ?");
    $stm->bindValue(1, $id);
    $stm->execute();

    $row = $stm->fetch(PDO::FETCH_ASSOC);

    echo "Id: " . $row['id'] . PHP_EOL;
    echo "Name: " . $row['name'] . PHP_EOL;
    echo "Population: " . $row['population'] . PHP_EOL;
?>