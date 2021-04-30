<?php
//typical logout system or a way of destroying the session completely.
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
?>