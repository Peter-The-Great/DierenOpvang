<?php
session_start();
require('../php/database.php');
if (!isset($_SESSION["loggedin"])) {
    header("Location: ../index.php");
    exit();
}

$sql = "SELECT id, soort FROM soort;";
$result = $conn->query($sql);

$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] =  $token;

if($stmt = $conn->prepare("SELECT naam, soortid, leeftijd, eigenaar_id, geboortedatum, regristratiedatum, naar, kenmerken, vaccinatie, image FROM dieren WHERE id = ?")) {
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($naam, $dier, $leeftijd, $eigenaar_id, $geboortedatum, $regristratiedatum, $naar, $kenmerken, $vaccinatie, $image);
        $stmt->fetch();
    }
}
if($stmt2 = $conn->prepare("SELECT soort FROM soort WHERE id = ?")) {
    $stmt2->bind_param("s", $dier);
    $stmt2->execute();
    $stmt2->store_result();

    if ($stmt2->num_rows > 0) {
        $stmt2->bind_result($dierennaam);
        $stmt2->fetch();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require("components/style.php"); ?>
    <title>DierenOpvang - Verander lesstof</title>
</head>

<body>
<?php require("components/navbar.php"); ?>
    <div class="container mt-2">
        <form method="POST" enctype="multipart/form-data" action="../php/changepost.php?id=<?php echo $_GET['id']; ?>">
            <input type="hidden" style="visibility: hidden;" name="token" value="<?php echo $token;?>">
            <div class="form-group">
                <label for="titel">Titel</label>
                <input name="title" id="titel" class="form-control" placeholder="Titel" type="text" value="<?php echo $naam;?>" required>
            </div>
            <div class="form-group">
                <label for="leeftijd">Leeftijd</label>
                <input name="leeftijd" id="leeftijd" type="number" class="form-control" placeholder="10" type="text" value="<?php echo $leeftijd;?>" required>
            </div>
            <div class="form-group">
                <label for="geboortedatum">Geboortedatum</label>
                <input name="geboortedatum" class="form-control" required type="date" id="geboortedatum" value="<?php echo $geboortedatum;?>">
            </div>
            <div class="form-group">
                <label for="registratiedatum">Registratiedatum</label>
                <input name="regristratiedatum" class="form-control" required type="date" id="regristratiedatum" value="<?php echo $regristratiedatum;?>">
            </div>
            <div class="form-group">
                <label for="naar">Gaat naar</label>
                <input name="naar" class="form-control" type="text" required id="subtext" value="<?php echo $naar;?>">
            </div>
            <div class="form-group">
                <label for="Kenmerken">Kenmerken</label>
                <input name="Kenmerken" class="form-control" required type="text" id="Kenmerken" value="<?php echo $kenmerken ?>" required>
            </div>
            <div class="form-group">
                <label for="Vaccinatie">Vaccinatie</label>
                <input name="Vaccinatie" class="form-control" type="text" id="Vaccinatie" value="<?php echo $vaccinatie;?>" required>
            </div>
            <div class="form-group">
                <label for="Huidige_Afbeelding">Huidige Achtergrond Foto</label><br>
                <input hidden="1" readonly="1" name="Huidige_Afbeelding" value="<?php echo $image;?>"><img src="../<?php echo "" . $image . "";?>" width="120" height="110">
            </div>
            <div class="form-group">
                <label for="foto">Achtergrond Foto</label>
                <input class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
                <label for="dier">Soort</label>
                <select class="form-select" required name="dier">
                <?php
                echo "<option selected value='". $dier ."' >". $dierennaam ." (Nu geregistreerd)</option>";
                //Hier loopen we door alle leerlijnen die dan vervolgens worden laten zien
                foreach ($result as $item) {
                    echo "<option value='".$item['id']."'>". $item['soort'] ."</option>";
                }
                ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-dark">
            </div>
            <?php
                if (isset($_GET['error=mysql'])) {
                    echo "<span style='color: rgb(0,185,255);'>The post wasn't send correctly.</span>";
                }
                if (isset($_GET['error=fields'])) {
                    echo "<span style='color: rgb(0,185,255);'>The post wasn't send correctly.</span>";
                }
                ?>
        </form>
    </div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php require("components/scripts.php"); ?>
</body>
</html>