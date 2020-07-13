<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$conn->set_charset("utf8");

if ($conn) {
    $query = "";
    // $sendRequest = mysqli_query($conn, $query);
    // $user = mysqli_fetch_assoc($sendRequest);
    // mysqli_close($conn);
}elseif(empty((isset($_SESSION['idUser'])))){
    header("location: login.php");
    exit();
}else{
    $msg = "Connection to the server failed, contact us if the problem persist";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Exercice Playlists</title>
</head>
<body>
    <?php
        include_once 'navbar.php'
    ?>
    <h1>Playlist</h1>

</body>
</html>