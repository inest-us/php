<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    
    $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    $server_version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    $autocommit_mode = $pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);

    echo "Driver: $driver <br />";
    echo "Server version: $server_version <br />";
    echo "Autocommit mode: $autocommit_mode <br />";
?>