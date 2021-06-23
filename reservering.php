<?php
require("php/database.php");
session_start();
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
<?php
require("components/scripts.php");
require("components/footer.php");
?>
</body>
</html>