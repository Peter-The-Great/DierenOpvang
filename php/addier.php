<?php
session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
// Insert into DATABASE
if(isset($_POST["name"])){
$name = strip_tags(htmlspecialchars($_POST['name']));

//function to give a a unique id
function uuidv4(){
	$data = openssl_random_pseudo_bytes(16);

	$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$randomid = uuidv4();
    if ($stmt = $conn->prepare("INSERT INTO `soort` (`id`, `soort`) values (?, ?)")) {
        $stmt->bind_param("ss", $randomid, $name);
        $stmt->execute();
        header("Location: ../admin/dashboard.php");
    } 
    else {
        header('Location: ../admin/dashboard.php?error=mysql');
    } 
} else {
    header('Location: ../admin/dashboard.php?error=fields');
}
?>