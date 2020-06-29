<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    $id = 10;
    $stm = $pdo->prepare("SELECT * FROM countries WHERE id = :id");
    $stm->bindParam(":id", $id, PDO::PARAM_INT);
    $stm->execute();

    $row = $stm->fetch(PDO::FETCH_ASSOC);

    echo "Id: " . $row['id'] . PHP_EOL;
    echo "Name: " . $row['name'] . PHP_EOL;
    echo "Population: " . $row['population'] . PHP_EOL;
?>