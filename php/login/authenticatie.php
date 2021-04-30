<?php
    session_start();
    require("../database.php");
    if(!isset($_POST["username"], $_POST["password"], $_POST["g-recaptcha-response"]) ) {
        session_destroy();
        header("Location: ../../admin/index.php?error=veld");
        return false;
    }
    if($_SESSION['ip'] !==  $_SERVER['REMOTE_ADDR']){
    header('Location: inlog.php?error=notthesameipadress');
    }
$response = $_POST["g-recaptcha-response"];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => '6Le3GeIZAAAAAOnO5JwQ4pnv0iAYtsUuxo2iYsuD',
    'response' => $response
);
$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success=json_decode($verify);

if ($captcha_success->success==false) {
    header("Location: inlog.php?catpcha=false");
} else if ($captcha_success->success==true) {
    if(!isset($_SESSION["token"]) || $_SESSION["token"] !== $_POST["token"]){
        echo "Wrong Token";
        header("Location: opdracht9.php?error=token");
    }
//here we are making a prepared statement so that we can use it to find our user.
    if($stmt = $conn->prepare("SELECT id,username,password FROM admin WHERE username = ?")) {
        $stmt->bind_param("s", $_POST["username"]);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $password);
            $stmt->fetch();
            //check for password and keep password in mind
            $pswrd = $_POST["password"];
            //for later if you want to change password
            $_SESSION['wachtwoord'] = $pswrd;
            if (sha1($pswrd) === $password) {
                session_regenerate_id();
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["name"] = $username;
                $_SESSION["id"] = $id;
                header("Location: ../../admin/dashboard.php");
            } else {
                session_start();
                session_destroy();
                header("Location: ../../admin/index.php?error=pass");
            }
        } else {
            session_start();
            session_destroy();
            header("Location: ../../admin/index.php?error=db");
        }
        $stmt->close();
    }
}
?>