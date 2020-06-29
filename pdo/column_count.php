<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    $stm = $pdo->query("SELECT name, population FROM countries WHERE id=1");
    $ncols = $stm->columnCount();

    echo "The result set contains $ncols columns\n";
?>