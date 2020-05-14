<?php

//$servername = "localhost";
//$username = "sam";
//$password = "sam";
//$dbname ="shopping";

$servername = "localhost";
$username = "wanshuwe_wanshuwe";
$password = "Canada@2020";
$dbname = "wanshuwe_book";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //set PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
//    echo dirname(__DIR__)."<br>";
//    echo $_SERVER['DOCUMENT_ROOT'];
} catch (PDOException $e) {
//    echo "Connection failed: " . $e->getMessage();
    die("Connection failed: " . $e->getMessage());
}

?>

