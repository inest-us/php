<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);

    $nrows = $pdo->exec("DELETE FROM countries WHERE id IN (1, 2, 3)");
    echo "The statement affected $nrows rows\n";
?>