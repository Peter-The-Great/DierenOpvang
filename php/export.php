<?php
session_start();
require('database.php');

if (!isset($_SESSION["loggedin"])) {
	header("Location: ../index.php");
	exit();
}
//instantiate and use the class
use Dompdf\Dompdf;
if(isset($_GET['id'])){
$pdf = new Dompdf();
if($stmt = $conn->prepare("SELECT `naam`, `soort`, `leeftijd`, `eigenaar_id`, `geboortedatum`, `regristratiedatum`, `naar`, `kenmerken`, `vaccinatie`, `image` FROM `dieren` WHERE id = ?")) {
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($naam, $soort, $leeftijd, $eigenaar_id, $geboortedatum, $registratiedatum, $naar, $kenmerken, $vaccinatie, $image);
        $stmt->fetch();
    }
}
// Get the image and convert into string
$img = file_get_contents("../" . $image);
$type = pathinfo($image, PATHINFO_EXTENSION);
// Encode the image string data into base64
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
// Display the output
//make the content here
//using output buffer
//or string variable
ob_start();
    ?>
    <h2>Informatie over <?php echo $naam; ?></h2>

    <table width="100%" border="1">
			<thead>
				<tr>
					<th>Naam</th>
					<th>Soort</th>
					<th>Leeftijd</th>
					<th>Eigenaar</th>
					<th>Geboortedatum</th>
					<th>Registratiedatum</th>
					<th>Naar</th>
                    <th>Kenmerken</th>
					<th>Vaccinatie</th>
                    <th>Afbeelding</th>
				</tr>
			</thead>
            <tbody>
            <td>
            <?php echo $naam; ?>
            </td>
            <td>
            <?php echo $soort; ?>
            </td>
            <td>
            <?php echo $leeftijd; ?>
            </td>
            <td>
            <?php echo $eigenaar_id; ?>
            </td>
            <td>
            <?php echo $geboortedatum; ?>
            </td>
            <td>
            <?php echo $registratiedatum; ?>
            </td>
            <td>
            <?php echo $naar; ?>
            </td>
            <td>
            <?php echo $kenmerken; ?>
            </td>
            <td>
            <?php echo $vaccinatie; ?>
            </td>
            <td>
            <img src="<?php echo $base64; ?>" width="120" height="110">
            </td>
            </tbody>
            </table>

<?php
$html=ob_get_clean();
$pdf->loadHtml($html);
//optional. Setup the paper size
$pdf->setPaper('A4', 'landscape');
//render the HTML as PDF
$pdf->render();
$pdf->stream("Export ".$naam, Array('Attachment'=>1));
header("Location: ../admin/dashboard.php");
}else{
    header("Location: ../admin/dashboard.php?error=pdfexportfailure");
}
?>