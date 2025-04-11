<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpapi";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    try{
        $sqlCategory = "CREATE TABLE IF NOT EXISTS category(
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(191) NOT NULL,
                        slug VARCHAR(191) NOT NULL,
                        description MEDIUMTEXT,
                        status TINYINT DEFAULT 0,
                        popular TINYINT DEFAULT 0,
                        image VARCHAR(191),
                        meta_title VARCHAR(191),
                        meta_description MEDIUMTEXT,
                        meta_keywords MEDIUMTEXT,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                        )";
                        $pdo->query($sqlCategory);

        $sqlProduct = "CREATE TABLE IF NOT EXISTS product(
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        category_id INT(11) NOT NULL,
                        name VARCHAR(191) NOT NULL,
                        slug VARCHAR(191) NOT NULL,
                        small_description MEDIUMTEXT NOT NULL,
                        description MEDIUMTEXT NOT NULL,
                        original_price INT(11) NOT NULL,
                        selling_price INT(11) NOT NULL,
                        image VARCHAR(191) NOT NULL,
                        qty INT(11) NOT NULL,
                        status TINYINT(4) NOT NULL DEFAULT 1,
                        trending TINYINT(4) NOT NULL DEFAULT 0,
                        meta_title VARCHAR(191),
                        meta_keywords MEDIUMTEXT,
                        meta_description MEDIUMTEXT,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                        )";
                    $pdo->query($sqlProduct);
        $sqlUser = "create table if not exists user(
                    id integer auto_increment primary key,
                    name varchar(100),
                    email varchar(191),
                    password varchar(25),
                    role_as TINYINT DEFAULT 0,
                    creared_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                    )";
                    $pdo->query($sqlUser);

        $sqlcarts = "CREATE TABLE IF NOT EXISTS carts(
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) NOT NULL,
                prod_id INT(11) NOT NULL,
                prod_qty INT(11) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                $pdo->query($sqlcarts);

        $sqlorders = "CREATE TABLE IF NOT EXISTS orders(
                id INT AUTO_INCREMENT PRIMARY KEY,
                tracking_no VARCHAR(191) NOT NULL,
                user_id INT(191) NOT NULL,
                name VARCHAR(191) NOT NULL,
                email VARCHAR(191) NOT NULL,
                phone VARCHAR(191) NOT NULL,
                address MEDIUMTEXT NOT NULL,
                pincode INT(191) NOT NULL,
                total_price INT(191) NOT NULL,
                payment_mode VARCHAR(191) NOT NULL,
                payment_id VARCHAR(191) NULL,
                status TINYINT DEFAULT 0,
                comments VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                $pdo->query($sqlorders);
        $sqlorderitems = "CREATE TABLE IF NOT EXISTS order_items(
                id INT AUTO_INCREMENT PRIMARY KEY,
                order_id INT(191) NOT NULL,
                prod_id INT(191) NOT NULL,
                qty INT(191) NOT NULL,
                price INT(191) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                $pdo->query($sqlorderitems);
        $sqlsettings = "CREATE TABLE IF NOT EXISTS settings(
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        image VARCHAR(255) NOT NULL,
                        title VARCHAR(255)  NOT NULL,
                        slug VARCHAR(255) NOT NULL,
                        meta_description TEXT,
                        small_description TEXT,
                        about_description1 TEXT,
                        about_description2 TEXT,
                        about_description3 TEXT,
                        about_description4 TEXT,
                        email1 VARCHAR(255) NOT NULL,
                        email2 VARCHAR(255) NOT NULL,
                        phone1 VARCHAR(50) NOT NULL,
                        phone2 VARCHAR(50) NOT NULL,
                        address TEXT NOT NULL,
                        contact_description TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                        )";
                $pdo->query($sqlsettings);
        echo "Table created successfully.";
    }catch(Exception $e){
        die("Connection failed: ". $e->getMessage());
    }
?>