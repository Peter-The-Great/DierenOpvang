<?php
session_start();
require('database.php');

if(!isset($_SESSION["token"]) || $_SESSION["token"] !== $_POST["token"]){
        echo "Wrong Token";
        header("Location: ../registratie.php?error=token");
}
global $conn;
// Insert into DATABASE
if(isset($_POST["naam"], $_POST["leeftijd"], $_POST["jaar"], $_POST["kenmerken"], $_POST['vaccinatie'], $_FILES['image'], $_POST['eigenaar'],$_POST['email'], $_POST['dier'])){
$naam = strip_tags(htmlspecialchars($_POST['naam']));
$leeftijd = strip_tags(htmlspecialchars($_POST['leeftijd']));
$kenmerken = strip_tags(htmlspecialchars($_POST['kenmerken']));
$eigenaar = strip_tags(htmlspecialchars($_POST['eigenaar']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$dier = strip_tags(htmlspecialchars($_POST['dier']));
$jaar = strip_tags(htmlspecialchars($_POST['jaar']));
$vacinne = strip_tags(htmlspecialchars($_POST['vaccinatie']));
$dateformat = 'Y-m-d';
$datum = date($dateformat, strtotime($jaar));

$image = $_FILES['image'];
$Tijdelijk = $image['tmp_name'];
$imagenaam = $image['name'];
$type = $image['type'];
$map = 'uploads/';
$Toegestaan = array("image/jpg","image/jpeg","image/png","image/gif");

if($stmt2 = $conn->prepare("SELECT soort FROM soort WHERE id = ?")) {
    $stmt2->bind_param("s", $dier);
    $stmt2->execute();
    $stmt2->store_result();

    if ($stmt2->num_rows > 0) {
        $stmt2->bind_result($soortnaam);
        $stmt2->fetch();
    }
}
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
$nugaatnaar = "DierenOpvang";
$randomid = uuidv4();
$eigennaarid = uuidv4();
    if ($stmt = $conn->prepare("INSERT INTO `dieren`(`id`, `naam`, `soort`, `leeftijd`, `eigenaar_id`, `geboortedatum`, `naar`, `kenmerken`, `vaccinatie`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
        $stmt->bind_param("ssssssssss", $randomid, $naam, $soortnaam, $leeftijd, $eigennaarid, $datum, $nugaatnaar, $kenmerken, $vacinne, $new_str);
        $stmt->execute();
        header("Location: ../index.php");
    }
    else {
        header('Location: ../registratie.php?error=mysql');
    } 
} else {
    header('Location: ../registratie.php?error=fields');
}
?>