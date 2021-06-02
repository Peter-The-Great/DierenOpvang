<?php
session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
if(!isset($_SESSION["token"]) || $_SESSION["token"] !== $_POST["token"]){
        echo "Wrong Token";
        header("Location: ../admin/profile.php?error=token");
}
// Update into DATABASE
if(isset($_POST["username"],$_POST["password"],$_POST["openname"],$_POST["email"],$_POST["Huidige_Afbeelding"])){
    
    $Huidig = $_POST['Huidige_Afbeelding'];
    $Afbeelding = $_FILES['image'];
    $Tijdelijk = $Afbeelding['tmp_name'];
    $Afbeeldingnaam = $Afbeelding['name'];
    $type = $Afbeelding['type'];
    $map = "uploads/";
    $unlink = "../";
    $Toegestaan = array("image/jpg","image/jpeg", "image/png", "image/gif");
    $sql = "";
    
    if ($Afbeelding['size'] == 0) {
        $sql = "UPDATE admin SET `username`=?, `password`=?, `realname`=?, `email`=? WHERE id='52086616-c85c-4363-98f0-4dcd698ec356'";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $_POST["username"], sha1($_POST["password"]), $_POST["openname"], $_POST["email"]);
        $stmt->execute();
        $stmt->close();
        header("Location: ../admin/dashboard.php");
    } 
    else {
        header('Location: ../admin/profile.php?error=mysql');
    } 
}
//hier wordt gekeken naar de huidige afbeeldingen en of het type van de afbeelding is toegestaan
elseif ($Afbeeldingnaam != $Huidig && in_array($type, $Toegestaan)) {
    unlink($unlink.$Huidig);
    $afbeelding = $map.$Afbeeldingnaam;
    $new_str = str_replace(' ', '', $afbeelding);
    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $new_str = $map . uniqid() . "_" . uniqid() . "." . $fileExt;
    move_uploaded_file($Tijdelijk, "../".$new_str);
    //Hier wordt de update query gemaakt
    $sql = "UPDATE admin SET `username`=?, `password`=?, `realname`=?, email=?, `profile`=? WHERE id='52086616-c85c-4363-98f0-4dcd698ec356'";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $_POST["username"], sha1($_POST["password"]), $_POST["openname"], $_POST["email"], $new_str);
        $stmt->execute();
        $stmt->close();
        header("Location: ../admin/dashboard.php");
    } 
    else {
        header('Location: ../admin/profile.php?error=mysql');
    } 
}else{
    header('Location: ../admin/profile.php?error=image_niet_geupload');
}

}
else {
    header('Location: ../admin/profile.php?error=fields');
}
?>