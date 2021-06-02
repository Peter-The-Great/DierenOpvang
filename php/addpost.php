<?php
session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
if(!isset($_SESSION["token"]) || $_SESSION["token"] !== $_POST["token"]){
        echo "Wrong Token";
        header("Location: ../admin/createpost.php?error=token");
}
// Insert into DATABASE
if(isset($_POST["title"], $_POST["text"], $_POST["subtext"], $_POST['leer'], $_FILES['image'], $_POST['uit'], $_POST['video'])){
$image = $_FILES['image'];
$Tijdelijk = $image['tmp_name'];
$imagenaam = $image['name'];
$type = $image['type'];
$map = 'uploads/';
$Toegestaan = array("image/jpg","image/jpeg","image/png","image/gif");
$titel = strip_tags(htmlspecialchars($_POST['title']));

//Get the video string
$videostring = str_replace('https://www.youtube.com/watch?v=', '', $_POST['video']);
$videostring1 = explode('&', $videostring);
$vidstring = $videostring1[0];


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
    header("Location: createpost.php?error=nietgeupload");
}
$randomid = uuidv4();
    if ($stmt = $conn->prepare("INSERT INTO subject (id, titel, subtext, text, image, video, leerlijn, uitgelicht) values (?, ?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param("ssssssss", $randomid, $titel, $_POST['subtext'], $_POST['text'], $new_str, $vidstring, $_POST['leer'], $_POST['uit']);
        $stmt->execute();
        header("Location: ../admin/dashboard.php");
    } 
    else {
        header('Location: ../admin/createpost.php?error=mysql');
    } 
} else {
    header('Location: ../admin/createpost.php?error=fields');
}