<?php
//Basis database setup, eerst zetten we alle error_reporting aan.
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';

//Hier laden we onze .env bestand, zodat we gebruik kunnen maken van alle omgevingsvariabelen.
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASSWORD'];
    $db = $_ENV['DB_NAME'];
    $host = $_ENV['DB_SERVER'];

    $conn = new mysqli($host, $user, $pass, $db) or die("Unable to connect");
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>