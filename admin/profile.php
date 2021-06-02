<?php
require("../php/database.php");
session_start();
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] =  $token;
if($stmt = $conn->prepare("SELECT `username`, `email`, `realname`, `profile` FROM `admin` WHERE `ID` = '52086616-c85c-4363-98f0-4dcd698ec356';")) {
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($uname, $email, $name,  $prof);
        $stmt->fetch();
        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require("components/style.php"); ?>
    <style>
    	#showitbtn{
    float: right;
    margin-top: -40px;
}
    </style>
    <title><?php echo $open; ?> - Profiel</title>
</head>
<body>
<?php require("components/navbar.php"); ?>
<div class="container mt-2">
        <form method="POST" enctype="multipart/form-data" action="../php/changeprofile.php">
        <input type="hidden" style="visibility: hidden;" name="token" value="<?php echo $token;?>">
        <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" class="form-control rounded" name="username" id="username" value="<?php echo $uname; ?>" required>
            </div>
            <div class="form-group">
                    <label>Wachtwoord</label>
                    <input name="password" id="password" lenght="32" class="form-control rounded" placeholder="******" type="password" required value="<?php echo $_SESSION['wachtwoord']?>">
                    <button id="showitbtn" class="btn" type="button"><i id="eyes" class="fas fa-eye"></i>
                    </button>
                </div>
            <div class="form-group">
                <label for="openname">Echte Naam</label>
                <input type="text" class="form-control rounded" name="openname" id="openname" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control rounded" name="email" id="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="foto">Huidige Achtergrond Foto</label><br>
                <input hidden="1" readonly="1" class="form-control rounded" name="Huidige_Afbeelding" value="<?php echo $prof;?>"><img class="img-fluid rounded" src="../<?php echo $prof ;?>">
            </div>
            <div class="form-group">
                <label for="foto">Achtergrond Foto</label>
                <input name="image" class="form-control-file" type="file">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-dark">
            </div>
            <?php
                if (isset($_GET['error=mysql'])) {
                    echo "<span style='color: rgb(0,185,255);'>The biography wasn't send correctly.</span>";
                }
                if (isset($_GET['error=fields'])) {
                    echo "<span style='color: rgb(0,185,255);'>The biography wasn't send correctly.</span>";
                }
                ?>
        </form>
    </div>
<?php require("components/scripts.php"); ?>
<script src="toggle.js"></script>
</body>
</html>