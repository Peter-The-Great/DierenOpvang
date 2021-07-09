<?php
require("php/database.php");
session_start();
if (!isset($_GET['id'])) {
	header("Location: ../index.php");
	return false;
}
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
    <title>Dieren Opvang Reservering</title>
</head>
<body>
<header style="background-image: url(<?php echo $image ?>) !important;" >
	<div class="container">
    <img class="img-fluid" width="120" src="uploads/simg/logo.png">
	    <h1 style="margin-top: -4rem;" class="text-center ms-4">Dierenopvang</h1>
		<p></p>
	</div>
</header>
<?php
    require("components/navbar.php");
?>
<section class="mt-3 mb-5 container" id="article">
		<div class="row">
			<p class="maxw"><?php echo $naam; ?></p>
            <img class='img-fluid' src='<?php echo $image ?>' width='120px'>
		</div>
	</section>
<?php
require("components/scripts.php");
require("components/footer.php");
?>
</body>
</html>