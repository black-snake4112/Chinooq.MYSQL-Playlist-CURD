<?php
$host = 'localhost';
$db   = 'chinook'; #database name known as chinook
$user = 'root';
$pass = '';
$charset = 'utf8mb4'; 
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO known as PHP Data Objects it is used for uniform and secure connection to database using  (Object oriented)code

$options = [ PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, ];
             
// PDO is PHP built in extension

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Connection to database is failed: " . $e->getMessage();
    exit;}?>

<!-- this php code connects the database known as chinook using the PDO , 
and if the connection failed it throws an error that Connection to database is failed -->