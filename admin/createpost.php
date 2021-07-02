<?php
session_start();
require('../php/database.php');
if (!isset($_SESSION["loggedin"])) {
    header("Location: ../index.php");
    exit();
}
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] =  $token;
$sql = "SELECT id, soort FROM soort;";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require("components/style.php"); ?>
    <title>DierenOpvang- Maak post</title>
</head>

<body>
<?php require("components/navbar.php"); ?>
<!-- Hier hebben we het formulier gemaakt voor het toevoegen van een post -->
<!-- Bij addpost staat de query voor het toevoegen dat we bij action hebben gezet. -->
    <div class="container mt-2">
        <form method="POST" enctype="multipart/form-data" action="../php/addpost2.php">
            <input type="hidden" style="visibility: hidden;" name="token" value="<?php echo $token;?>">
            <div class="form-group">
                <label for="naam">Naam</label>
                <input name="naam" id="naam" class="form-control" placeholder="Naam" type="text" required>
            </div>
            <div class="form-group">
                <label for="naam">Leeftijd</label>
                <input name="leeftijd" id="leeftijd" min="0" class="form-control" placeholder="10" type="number" required>
            </div>
            <div class="form-group">
                <label for="jaar">Geboortedatum</label>
                <input name="jaar" type="date" class="form-control" id="jaar" required></input>
            </div>
            <div class="form-group">
                <label for="kenmerken">Kenmerken</label>
                <input name="kenmerken" type="text" class="form-control" id="kenmerken" required></input>
            </div>
            <div class="form-group">
                <label for="vaccinatie">Vaccinatie</label>
                <textarea class="form-control" name="vaccinatie" id="subtext"></textarea required>
            </div>
            <div class="form-group">
                <label for="eigenaar">Eigenaar</label>
                <textarea class="form-control" name="eigenaar" id="subtext"></textarea required>
            </div>
            <div class="form-group">
                <label for="email">Eigenaar-email</label>
                <input class="form-control" type="email" name="email" id="email"></input required>
            </div>
            <div class="form-group">
                <label for="foto">Achtergrond Foto</label>
                <input class="form-control" name="image" type="file">
            </div>
            <div class="form-group mb-2">
                <label for="dier">Type dier</label>
                <select class="form-select" required name="dier">
                <option selected disabled>-- selecteer dier --</option>
                <?php
                //Hier loopen we door alle dieren die dan vervolgens worden laten zien
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
            //Wanneer de post niet goed is uitgevoerd krijg je een error
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