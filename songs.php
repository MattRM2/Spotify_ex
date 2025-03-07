<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$conn->set_charset("utf8");

$query = "SELECT songs.title, release_date, name, song_id, categories.title AS cat FROM songs INNER JOIN artists ON songs.artist_id=artists.artist_id INNER JOIN categories ON songs.categ_id=categories.categ_id ORDER BY artists.name";

if ($conn) {
    if (isset($_POST['sort'])) {
        $selectedVal = $_POST['selectSort'];
        $query = "SELECT songs.title, release_date, name, song_id, categories.title AS cat FROM songs INNER JOIN artists ON songs.artist_id=artists.artist_id INNER JOIN categories ON songs.categ_id=categories.categ_id ORDER BY $selectedVal";
        //TODO KEEP LAST SELECTED CHOICES
    }
    $sendRequest = mysqli_query($conn, $query);
    $songsList = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);

    //* PUT LIST OPTION ONLY IF LOGGED
    if (!empty((isset($_SESSION['idUser'])))) {
        $id = explode('-', $_SESSION['idUser']);
        $id = $id[1]; //? [0] = email, [1] = user_id
        $query = "SELECT * FROM playlists WHERE user_id='$id'";
        $sendRequest = mysqli_query($conn, $query);
        $myPlaylist = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
    }

    //* INSERT NEW SONG IN PLAYLIST
    if (isset($_POST['add2Pl']) && !empty((isset($_SESSION['idUser'])))) {
        $pushsong2PL = $_POST['selectSongPL'];
        $PL = explode('-', $pushsong2PL)[0];
        $SONGsel = explode('-', $pushsong2PL)[1];
        //* DEBUG
        // echo $PL.'<br>';
        // echo $SONGsel;
        $query = "INSERT INTO playlist_content (playlist_id, song_id) VALUE ($PL, $SONGsel)";
        $sendRequest = mysqli_query($conn, $query);
    }
    mysqli_close($conn);
}else{
    $msg = "Connection to the server failed, contact us if the problem persist";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Exercice Songs</title>
</head>
<body>
    <?php
        include_once 'navbar.php';
    ?>
    <h1>Songs</h1>
    <h2>List of songs</h2>
    <form name="list" method="POST">
        <label for="selectId">Show by</label>
        <select name="selectSort" id="selectId" value="<?= $selectedVal?>">
            <option value="artists.name">Artists Name</option>
            <option value="title">Songs Name</option>
        </select>
        <input type="submit" name="sort" value="Sort By">
    </form>
    <hr>
    <?php foreach($songsList as $song) : ?>
        <form name="songBlock" method="POST">
            <span style="font-size:1.5rem;font-weight:bold"><?= $song['title']?>
                <?php
                    if (!empty((isset($_SESSION['idUser'])))) {
                        echo '<select name="selectSongPL" id="">';
                        foreach ($myPlaylist as $currentPlaylist) {
                            echo '<option value="'.$currentPlaylist['playlist_id'].'-'.$song['song_id'].'">'.$currentPlaylist['title'].'</option>';
                        }
                        echo '</select>';
                        echo '<input type="submit" name="add2Pl" value="Add">';
                    }else{
                        echo '';
                    }
                ?>
            </span>
        </form><br>
        <span>Artist  : <?= $song['name']?></span><br>
        <span>Released date  : <?= $song['release_date']?></span><br>
        <span>Category : <?= $song['cat']?></span><br><br>
    <?php endforeach;?>

</body>
</html>
<option value=""></option>