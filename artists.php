<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$conn->set_charset("utf8");


if ($conn) {
    $query = "SELECT * FROM artists";
    $sendRequest = mysqli_query($conn, $query);
    $artists = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
    // var_dump($artists);
}else{
    $msg = "Connection to the server failed, contact us if the problem persist";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Exercice Artists</title>
</head>
<body>
    <?php
        include_once 'navbar.php'
    ?>
    <h1>Artists</h1>
    <h2>List of artists</h2>
    <?php foreach($artists as $artist) :?>
        <h3><?= $artist['name']?></h3>
        <span>Genre : <?= $artist['gender']?></span><br>
        <span>Date of birth : <?= $artist['date_of_birth']?></span><br>
        <span>Bio : <?php 
            if (strlen($artist['bio']) > 60) {
                $bio = substr($artist['bio'], 0, 57).'...';
                echo $bio;
            }
        ?></span><br>

    <?php endforeach; ?>
</body>
</html>