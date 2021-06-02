<?php
session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
// Insert into DATABASE
if(isset($_POST["name"], $_POST["subtext"], $_FILES['image'])){
$image = $_FILES['image'];
$Tijdelijk = $image['tmp_name'];
$imagenaam = $image['name'];
$type = $image['type'];
$map = 'uploads/simg/';
$Toegestaan = array("image/jpg","image/jpeg","image/png","image/gif");
$name = strip_tags(htmlspecialchars($_POST['name']));

//function to give a a unique id
function uuidv4(){
	$data = openssl_random_pseudo_bytes(16);

	$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
//here we are making sure that the image is moved to its right location.
$afbeelding = $map.$imagenaam;
$new_str = str_replace(' ', '', $afbeelding);
$fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$new_str = $map . uniqid() . "_" . uniqid() . "." . $fileExt;
if (in_array($type,$Toegestaan)){
    move_uploaded_file($Tijdelijk, "../".$new_str);
}else{
    header("Location: dashboard.php?error=nietgeupload");
}
$randomid = uuidv4();
    if ($stmt = $conn->prepare("INSERT INTO `cat` (`ID`, `name`, `subtext`, `headimage`) values (?, ?, ?, ?)")) {
        $stmt->bind_param("ssss", $randomid, $name, $_POST['subtext'], $new_str);
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