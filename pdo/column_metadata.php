<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    
    $stm = $pdo->query("SELECT * FROM countries WHERE id=1");
    $col_meta = $stm->getColumnMeta(0);

    echo "Table name: {$col_meta["table"]} <br />";
    echo "Column name: {$col_meta["name"]} <br />";
    echo "Column length: {$col_meta["len"]} <br />";
    echo "Column flags: {$col_meta["flags"][0]} {$col_meta["flags"][1]} <br />";
?>