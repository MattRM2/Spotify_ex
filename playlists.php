<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
// $conn->set_charset("utf8");

if ($conn && !empty((isset($_SESSION['idUser'])))) {
    if (isset($_POST['add'])) {
        $playlistName = $_POST['playlistName'];
        $creationDate = date('Y-m-d', date('U'));
        $id = explode('-', $_SESSION['idUser']);
        $id = $id[1]; //? [0] = email, [1] = user_id

        $query = "INSERT INTO playlists (title, creation_date, user_id) VALUE ('$playlistName', '$creationDate', '$id')";
        $sendRequest = mysqli_query($conn, $query);

    }
    $query = "SELECT * FROM playlists";
    $sendRequest = mysqli_query($conn, $query);
    $myPlaylist = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
    mysqli_close($conn);

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

    <h2>Create playlist</h2>
    <form method="POST">
        <input type="text" name="playlistName" placeholder="Playlist name">
        <input type="submit" name="add" value="Add">
    </form>
    <h2>Your Playlists</h2>
    <ul>
        <?php foreach($myPlaylist as $currentPlaylist) :?>
            <li><?= $currentPlaylist['title']?></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>