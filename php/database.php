<?php
//basic database setup and configuration
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
    $user = 'root';
    $pass = '';
    $db = 'dieren';
    $host = '127.0.0.1';

    $conn = new mysqli($host, $user, $pass, $db) or die("Unable to connect");
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>