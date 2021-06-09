<?php
//include autoloader
require_once 'autoload.inc.php';

//instantiate and use the class
use Dompdf\Dompdf;

$pdf = new Dompdf();

//make the content here
//using output buffer
//or string variable
ob_start();
    ?>
    <h2>Basic HTML Table</h2>

<table border='1' style="width:100%">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Age</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
  </tr>
  <tr>
    <td>John</td>
    <td>Doe</td>
    <td>80</td>
  </tr>
</table>

<?php

$html=ob_get_clean();


$pdf->loadHtml($html);

//optional. Setup the paper size
$pdf->setPaper('A4', 'landscape');

//render the HTML as PDF
$pdf->render();

$pdf->stream('result', Array('Attachment'=>0));

?>