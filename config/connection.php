<?php
$host = "localhost";
$dbname = "shopmanager";
$user = "root";
$pass = "";

$dsn ="mysql:host=$host;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];
try{
    $conn = new pdo($dsn, $user, $pass, $options);
    
}catch(PDOException $e){
    echo $e->message;
}

?>