<?php
include dirname(__DIR__) . '/config/connect.php';

//create tables
$command = "CREATE TABLE IF NOT EXISTS products (
            productid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(450) NOT NULL,
            description VARCHAR(540) NOT NULL,
            price FLOAT(10),
            imgpath VARCHAR(1024) NOT NULL
            )";

$stmt = $conn->prepare($command);
$stmt->execute();

$command = "CREATE TABLE IF NOT EXISTS customer (
            userid VARCHAR(40) NOT NULL PRIMARY KEY,
            password VARCHAR(200) NOT NULL,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL
            )";

$stmt = $conn->prepare($command);
$stmt->execute();

$command = "CREATE TABLE IF NOT EXISTS billing(
            id INT(40) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userid VARCHAR(200) NOT NULL,
            firstname VARCHAR(240) NOT NULL,
            lastname VARCHAR(240) NOT NULL,
            account VARCHAR(240) NOT NULL,
            expireddate VARCHAR(240) NOT NULL,
            securitycode VARCHAR(240) NOT NULL,
            address VARCHAR(1024) NOT NULL,
            city VARCHAR(1024) NOT NULL,
            country VARCHAR(1024) NOT NULL,
            postcode VARCHAR(1024) NOT NULL
            )";

$stmt = $conn->prepare($command);
$stmt->execute();

$command = "CREATE TABLE IF NOT EXISTS delivery (
            id INT(40) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userid VARCHAR(40) NOT NULL,
            firstname VARCHAR(40) NOT NULL,
            lastname VARCHAR(40) NOT NULL,
            phone VARCHAR(40) NOT NULL,
            email VARCHAR(40) NOT NULL,
            address VARCHAR(1024) NOT NULL,
            city VARCHAR(1024) NOT NULL,
            country VARCHAR(1024) NOT NULL,
            postcode VARCHAR(1024) NOT NULL
            )";
$stmt = $conn->prepare($command);
$stmt->execute();

$command = "CREATE TABLE IF NOT EXISTS orders (
            id INT(40) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            orderid VARCHAR(40) NOT NULL,
            productid INT(10) NOT NULL,
            productname VARCHAR(50) NOT NULL,
            userid VARCHAR(40) NOT NULL,
            price FLOAT(10),
            quantity INT(10),
            totalprice FLOAT(20),
            imgpath VARCHAR(512) NOT NULL,
            billing VARCHAR(1024) NOT NULL,
            delivery VARCHAR(1024) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
$stmt = $conn->prepare($command);
$stmt->execute();
