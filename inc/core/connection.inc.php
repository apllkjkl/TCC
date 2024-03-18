<?php 
    $dbh = "mysql:host=localhost;dbname=tcc";
    $dbusername = "root";
    $dbpassword = "usbw"; //Se usar o wamp esse campo deve ficar vazio.

    try {
        $pdo = new PDO($dbh, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<h1>Connection failed: " . $e->getMessage() . "</h1>";
        die();
    }
    
    return $pdo;