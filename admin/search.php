<?php
session_start();
require('../php/database.php');
if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
$sql = "SELECT id,titel,date FROM subject WHERE `titel` LIKE '%". $_POST['search'] ."%' ORDER BY date DESC;";
$result = $conn->query($sql);
$sql2 = "SELECT id,name FROM cat;";
$result2 = $conn->query($sql2);
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php require("style.php"); ?>
	<title><?php echo $open; ?> - Dashboard</title>
	<script src="https://cdn.tiny.cloud/1/swq7hpikkqwjjze9ad6mykwgy37w7e1mlvbbslqdqokoedyw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#subtext',
            height: '200',
            plugins: ['wordcount'],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic ' +
                '| link unlink | bullist numlist outdent indent | ' +
                'removeformat' + '| help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
</head>
<body>
<?php require("navbar.php"); ?>
<!-- Hieroner hebben we de tabel gemaakt die alles laat zien --> 
<div class="container">
	<a href="createpost.php" class="btn btn-primary mt-5"><i class="fas fa-user-plus"></i> Lesstof Aanmaken</a>
	<button class="btn btn-secondary mt-5" data-bs-toggle="modal" data-bs-target="#leerlijnenmodal"><i class="fas fa-user-plus"></i> Leerlijnen</button>
	<div class="center-div">
		<table class="table mt-2">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Titel</th>
					<th scope="col">Datum</th>
					<th scope="col">Bekijken</th>
					<th scope="col">Aanpassen</th>
					<th scope="col">Verwijderen</th>
				</tr>
			</thead>
			<tbody id="table-body">
				<?php
				foreach ($result as $item) {
					echo "<td>" . $item["titel"] . "</td><td>" .  $item["date"] . "</td></td><td><a href='../video.php?id=" . $item['id'] . "' class='btn btn-info btn-lg'><i class='fas fa-eye'></i></a></td><td><a href='changepost.php?id=" . $item['id'] . "' class='btn btn-warning btn-lg'><i class='fas fa-user-edit'></i></a></td><td><button type='button' data-bs-toggle='modal' data-bs-target='#post". $item['id'] ."' class='btn btn-danger btn-lg'><i class='fas fa-trash-alt'></i></button></td><tr>
					<div class='modal fade' id='post". $item['id'] ."' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='postlabel". $item['id'] ."' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='postlabel". $item['id'] ."'>Modal title</h5>
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
        <h5 class="modal-title h4" id="leerlijnenmodalLabel">Leerlijnen Toevoegen of Verwijderen</h5>
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
			//Hier kunnen we leerlijnen verwijderen.
			foreach ($result2 as $item2) {
				echo "<td>" . $item2["name"] . "</td><td><a href='../php/deleteleer.php?id=". $item2['id'] ."'><button type='button' class='btn btn-danger btn-lg'><i class='fas fa-trash-alt'></i></button></a></td><tr>";
			}
			?>
			</tbody>
			</table>
			<form method="POST" enctype="multipart/form-data" action="../php/addleer.php">
			<div class="form-group">
                <label for="naam">Leerlijn Naam</label>
                <input name="name" id="name" class="form-control" placeholder="Naam Leerlijn" type="text" required>
            </div>
			<div class="form-group">
                <label for="subtext">Omschrijving</label>
                <textarea name="subtext" id="subtext"></textarea required>
            </div>
			<div class="form-group">
                <label for="image">Leerlijn Profiel</label>
                <input name="image" type="file" required>
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
<?php require("scripts.php"); ?>
<script type="text/javascript" src="search.js"></script>
</body>
</html>