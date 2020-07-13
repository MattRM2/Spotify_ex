<?php
session_start();

if (!empty($_SESSION['idUser'])) {
    unset($_SESSION['idUser']);
    $msg = "You're logout";
    header("location: login.php");
    exit();
}
?>