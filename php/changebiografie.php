<?php

session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
if(!isset($_SESSION["token"]) || $_SESSION["token"] !== $_POST["token"]){
        echo "Wrong Token";
        header("Location: ../admin/info.php?error=token");
    }
// Insert into DATABASE
if(isset($_POST["text"])){
    $sql = "UPDATE info SET text=? WHERE id=1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "s",
            $_POST["text"],
        );
    
        $stmt->execute();
        $stmt->close();
        header("Location: ../info.php");
    } 
    else {
        header('Location: ../admin/changebiografie.php?error=mysql');
    } 
}else {
    header('Location: ../admin/changebiografie.php?error=fields');
}
?>