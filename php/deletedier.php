<?php
session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
}
$id = $_GET["id"];
if(isset($id)){
    $stmt = $conn->prepare("DELETE FROM soort WHERE `id` = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
header("location: ../admin/dashboard.php");
?>