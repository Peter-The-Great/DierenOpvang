<?php

session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
//Hier moet een get die de id uit de url gaat halen
//basic delete function and deletion of an image with the part itself
$id = $_GET["id"];
$unlink = "../";
$stmt = $conn->prepare("SELECT `image` FROM `dieren` WHERE `id` = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($Huidig);
$stmt->fetch();
unlink($unlink.$Huidig);

if(isset($id)){
    $stmt = $conn->prepare("DELETE FROM `dieren` WHERE `id` = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    header("location: ../admin/dashboard.php");
}
?>