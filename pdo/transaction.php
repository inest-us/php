<?php
    require_once 'config.php';

    $pdo = new PDO($dsn, $user, $passwd);
    
    $sql = "CREATE TABLE words(id INT PRIMARY KEY AUTO_INCREMENT, word VARCHAR(255))";

    try {

        $pdo->beginTransaction();
        $stm = $pdo->exec("INSERT INTO countries(name, population) VALUES ('Iraq', 38274000)");
        $stm = $pdo->exec("INSERT INTO countries(name, population) VALUES ('Uganda', 37673800)");
    
        $pdo->commit();
    
    } catch(Exception $e) {
    
        $pdo->rollback();
        throw $e;
    }
?>