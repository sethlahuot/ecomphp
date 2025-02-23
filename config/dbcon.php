<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpapi";

    $pdo = new PDO("mysql:host=$host", $username, $password);
    try{
        $sql = "Create database $dbname";
        $pdo->exec($sql);
         echo "Database created successfully";
    }catch(Exception $e){
        die("Connetion failed1:". $e->getMessage());
    }
?>