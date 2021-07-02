<?php
session_start();
require('../php/database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
$sql = "SELECT `id`, `naam`, `soort`, `leeftijd`, `eigenaar_id`, `geboortedatum`, `regristratiedatum`, `naar`, `kenmerken`, `vaccinatie`, `image` FROM `dieren`;";
$result = $conn->query($sql);
$sql2 = "SELECT id,soort FROM soort;";
$result2 = $conn->query($sql2);
$username = $_SESSION['name'];
$id = $_SESSION['id'];
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php require("components/style.php"); ?>
	<title>DierenOpvang - Dashboard</title>
</head>
<body>
<?php require("components/navbar.php"); ?>
<!-- Hieroner hebben we de tabel gemaakt die alles laat zien --> 
<div class="container">
	<a href="createpost.php" class="btn btn-primary mt-5"><i class="fas fa-user-plus"></i> Dier Aanmaken</a>
	<button class="btn btn-secondary mt-5" data-bs-toggle="modal" data-bs-target="#leerlijnenmodal"><i class="fas fa-user-plus"></i> Type dier</button>
	<div class="center-div">
		<table class="table mt-2">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Naam</th>
					<th scope="col">Registratiedatum</th>
					<th scope="col">Soort</th>
					<th scope="col">Leeftijd</th>
					<th scope="col">Geboortedatum</th>
					<th scope="col">Kenmerken</th>
					<th scope="col">Vaccinatie</th>
					<th scope="col">Bekijken</th>
					<th scope="col">Export</th>
					<th scope="col">Aanpassen</th>
					<th scope="col">Verwijderen</th>
				</tr>
			</thead>
			<tbody>

				<?php
				foreach ($result as $item) {
					echo "<td>" . $item["naam"] . "</td><td>" .  $item["regristratiedatum"] . "</td>
					<td>" .  $item["soort"] . "</td><td>" .  $item["leeftijd"] . "</td><td>" .  $item["geboortedatum"] . "</td>
					<td>" .  $item["kenmerken"] . "</td><td>" .  $item["vaccinatie"] . "</td><td><a href='../reservering.php?id=" . $item['id'] . "' class='btn btn-info btn-lg'><i class='fas fa-eye'></i></a></td><td><a href='../php/export.php?id=" . $item['id'] . "' class='btn btn-success btn-lg'><i class='fas fa-file-download'></i></a></td><td><a href='changepost.php?id=" . $item['id'] . "' class='btn btn-warning btn-lg'><i class='fas fa-user-edit'></i></a></td><td><button type='button' data-bs-toggle='modal' data-bs-target='#post". $item['id'] ."' class='btn btn-danger btn-lg'><i class='fas fa-trash-alt'></i></button></td><tr>
					<div class='modal fade' id='post". $item['id'] ."' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='postlabel". $item['id'] ."' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='postlabel". $item['id'] ."'>". $item["naam"] ." verwijderen!</h5>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                            <b>Weet je zeker dat je de post wilt verwijderen? Deze actie kan niet ongedaan worden!</b>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Sluiten</button>
                              <a href='../php/removepost.php?id=" . $item["id"] . "'><button type='button' class='btn btn-danger'>Jazeker</button></a>
                            </div>
                          </div>
                        </div>
                      </div>";
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="leerlijnenmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="leerlijnenmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="leerlijnenmodalLabel">Type dier Toevoegen of Verwijderen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <div class="center-div">
		<table class="table mt-2">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Titel</th>
					<th scope="col">Verwijderen</th>
				</tr>
			</thead>
			<tbody>
			<?php
			//Hier kunnen we dieren verwijderen.
			foreach ($result2 as $item2) {
				echo "<td>" . $item2["soort"] . "</td><td><a href='../php/deletedier.php?id=". $item2['id'] ."'><button type='button' class='btn btn-danger btn-lg'><i class='fas fa-trash-alt'></i></button></a></td><tr>";
			}
			?>
			</tbody>
			</table>
			<form method="POST" enctype="multipart/form-data" action="../php/addier.php">
			<div class="form-group">
                <label for="naam"> Naam Type dier</label>
                <input name="name" id="name" class="form-control" placeholder="Naam Type dier" type="text" required>
            </div>
			<div class="form-group">
                <input type="submit" name="submit" class="btn btn-dark">
            </div>
			</form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<?php require("components/scripts.php"); ?>
</body>
</html>