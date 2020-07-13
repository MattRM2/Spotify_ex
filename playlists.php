<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
// $conn->set_charset("utf8");


if ($conn && !empty((isset($_SESSION['idUser'])))) {
    $id = explode('-', $_SESSION['idUser']);
    $id = $id[1]; //? [0] = email, [1] = user_id
    //* ADD PLAYLIST
    if (isset($_POST['add'])) {
        $playlistName = $_POST['playlistName'];
        $creationDate = date('Y-m-d', date('U'));

        $query = "INSERT INTO playlists (title, creation_date, user_id) VALUE ('$playlistName', '$creationDate', '$id')";
        $sendRequest = mysqli_query($conn, $query);
        header('location: playlists.php');
    }
    //* GET PLAYLIST TO GENERATE HTML
    $query = "SELECT * FROM playlists WHERE user_id='$id'";
    $sendRequest = mysqli_query($conn, $query);
    $myPlaylist = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);

    //* WTF COMMAND TO GET DATA FROM SONGS TABLE AND PLAYLISTS USING INTERMEDIATE TABLE TO GENERATE PLAYLISTS' SONG BY PLAYLIST
    //? SOURCE : https://dba.stackexchange.com/questions/51637/query-an-intermediate-table-and-join-to-child-table
    $query = "SELECT playlist_content.playlist_id, playlist_content.song_id, playlists.playlist_id AS plid, songs.title AS sgtitle FROM playlist_content 
    INNER JOIN playlists 
    ON playlist_content.playlist_id=playlists.playlist_id
    INNER JOIN songs
    ON playlist_content.song_id=songs.song_id";
    $sendRequest = mysqli_query($conn, $query);
    $myIntTable = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);

    //* COMMANDS TO CLEAN PLAYLISTS CONTENT AND PLAYLISTS - LITTLE HACK TO REFRESH PAGE...
    if (isset($_POST['CPC'])) {
        $queryD = "DELETE FROM playlist_content";
        $sendRequestD = mysqli_query($conn, $queryD);
        header('location: playlists.php');
    }
    if (isset($_POST['CAC'])) {
        $queryD = "DELETE FROM playlists";
        $sendRequestD = mysqli_query($conn, $queryD);
        header('location: playlists.php');
    }

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
    <form method="POST">
        <input type="submit" name="CPC" value="1 - Clean Playlist Content">
        <input type="submit" name="CAC" value="2 - Clean All Playlists">
    </form>
    <?php foreach($myPlaylist as $currentPlaylist) :?>
        <h4><?= $currentPlaylist['title']?></h4>
        <ul>
            <?php foreach($myIntTable as $currentSong) :?>
                <?php 
                if ($currentPlaylist['playlist_id'] == $currentSong['plid']) {
                    echo '<li>'.$currentSong['sgtitle'].'</li>';
                }
                ?>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

</body>
</html>