<?php
require("php/database.php");
session_start();

$sql = "SELECT `id`, `naam`, `soort`, `leeftijd`, `eigenaar_id`, `geboortedatum`, `regristratiedatum`, `naar`, `kenmerken`, `vaccinatie`, `image` FROM `dieren`;";
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
    <title>Dieren Opvang</title>
</head>
<body class="h-100">
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
<div class="center-div">
		<table class="table table-dark table-hover mx-auto mt-2">
			<tbody>
				<?php
				foreach ($result as $item) {
					echo "<a href='reservering.php?id=" . $item['id'] . "'><tr><td><img class='img-fluid' src='". $item["image"] ."' width='120' height='100'></td><td>" . $item["naam"] . "</td><td>" .  $item["regristratiedatum"] . "</td>
					<td>" .  $item["soort"] . "</td><td>" .  $item["leeftijd"] . "</td><td>" .  $item["geboortedatum"] . "</td>
					<td>" .  $item["kenmerken"] . "</td><td>" .  $item["vaccinatie"] . "</td></tr></a>";
				}
				?>
			</tbody>
		</table>
	</div>
<?php
require("components/scripts.php");
require("components/footer.php");
?>
</body>
</html>