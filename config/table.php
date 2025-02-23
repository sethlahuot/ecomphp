<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpapi";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    try{
        $sqlCategory = "create table if not exists category(
                        id integer auto_increment primary key,
                        name varchar(100)
                        )";
                        
        $pdo->query($sqlCategory);

        $sqlProduct = "create table if not exists product(
                        id integer auto_increment primary key,
                        image text,
                        active integer default 1,
                        `order` integer,
                        category_id integer,
                        foreign key (category_id) references category(id) on delete cascade
                        )";

                    $pdo->query($sqlProduct);
        $sqlUser = "create table if not exists user(
                    id integer auto_increment primary key,
                    name varchar(100),
                    email varchar(191),
                    password varchar(25),
                    creared_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                    )";
                    $pdo->query($sqlUser);
        echo "Table created successfully.";
    }catch(Exception $e){
        die("Connection failed: ". $e->getMessage());
    }
?>