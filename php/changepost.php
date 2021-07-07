<?php
session_start();
require('database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
if(!isset($_SESSION["token"]) || $_SESSION["token"] !== $_POST["token"]){
        echo "Wrong Token";
        header("Location: ../admin/changepost.php?error=token");
}
// Insert into DATABASE 
//$_POST['eigenaar'], $_POST['email']
if(isset($_POST["naam"], $_POST["leeftijd"], $_POST["jaar"], $_POST["kenmerken"], $_POST['vaccinatie'], $_POST['dier'])){
    $naam = strip_tags(htmlspecialchars($_POST['naam']));
    $leeftijd = strip_tags(htmlspecialchars($_POST['leeftijd']));
    $kenmerken = strip_tags(htmlspecialchars($_POST['kenmerken']));
    //$eigenaar = strip_tags(htmlspecialchars($_POST['eigenaar']));
    //$email = strip_tags(htmlspecialchars($_POST['email']));
    $dier = strip_tags(htmlspecialchars($_POST['dier']));
    $jaar = strip_tags(htmlspecialchars($_POST['jaar']));
    $vacinne = strip_tags(htmlspecialchars($_POST['vaccinatie']));
    $nugaatnaar = $_POST["naar"];
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

    //if it has no image dont put the post in a query
    if (empty($image) || $image['size'] == 0) {
    $sql = "UPDATE `dieren` SET `naam`=?,`soort`=?,`soortid`=?,`leeftijd`=?,`eigenaar_id`=?,`geboortedatum`=?,`naar`=?,`kenmerken`=?,`vaccinatie`=? WHERE `id`=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $naam, $soortnaam, $dier, $leeftijd, $eigennaarid, $datum, $nugaatnaar, $kenmerken, $vacinne, $_GET['id']);
        $stmt->execute();
        header("Location: ../admin/dashboard.php");
    }
    else {
        header('Location: ../admin/changepost.php?error=mysql');
    }
}//but if it does have an image and the image is not the same image then we will proceed to put it in the query and unlink the previous set image
elseif ($imagenaam != $Huidig && in_array($type, $Toegestaan)) {
        unlink($unlink.$Huidig);
        $imagenew = $map.$imagenaam;
        $new_str = str_replace(' ', '', $imagenew);
        $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_str = $map . uniqid() . "_" . uniqid() . "." . $fileExt;
        move_uploaded_file($Tijdelijk, "../".$new_str);
        $sql = "UPDATE `dieren` SET `naam`=?,`soort`=?,`soortid`=?,`leeftijd`=?,`eigenaar_id`=?,`geboortedatum`=?,`naar`=?,`kenmerken`=?,`vaccinatie`=?,`image`=? WHERE `id`=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssssss", $naam, $soortnaam, $dier, $leeftijd, $eigennaarid, $datum, $nugaatnaar, $kenmerken, $vacinne, $new_str, $_GET['id']);
            $stmt->execute();
            header("Location: ../admin/dashboard.php");
        }
        else {
            header('Location: ../admin/changepost.php?error=mysql');
        }
    }else {
        header('Location: ../admin/changepost.php?error=image_niet_geupload');
    }
}else {
    header('Location: ../admin/changepost.php?error=fields');
}
?>