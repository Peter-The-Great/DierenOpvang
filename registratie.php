<?php
require("php/database.php");
session_start();
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] =  $token;
$sql = "SELECT id, soort FROM soort;";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dieren Opvang de Haard, neem hier uw dieren naartoe om ze te laten genieten van een van de beste dierenopvangcentra in Nederland.">
    <?php
    require("components/style.php");
    ?>
    <title>Dieren Opvang Registratie</title>
</head>
<body>
<header>
	<div class="container">
    <img class="img-fluid" width="120" src="uploads/simg/logo.png">
	    <h1 style="margin-top: -4rem;" class="text-center ms-4">Dierenopvang</h1>
		<p></p>
	</div>
</header>
<?php
require("components/navbar.php");
?>
<div class="container mt-2">
        <form method="POST" enctype="multipart/form-data" action="php/addpost.php">
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
<?php
require("components/scripts.php");
require("components/footer.php");
?>
</body>
</html>