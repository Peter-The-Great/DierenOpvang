<?php
require("../php/database.php");
$sql = "SELECT id,titel,date FROM subject WHERE `titel` LIKE '%". $_POST['search'] ."%' ORDER BY date DESC;";
$result = $conn->query($sql);
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