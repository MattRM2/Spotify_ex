<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$conn->set_charset("utf8");

$query = "SELECT title, release_date, name FROM songs INNER JOIN artists ON songs.artist_id=artists.artist_id ORDER BY artists.name";

if ($conn) {
    if (isset($_POST['sort'])) {
        $selectedVal = $_POST['select'];
        $query = "SELECT title, release_date, name FROM songs INNER JOIN artists ON songs.artist_id=artists.artist_id ORDER BY $selectedVal";
        //TODO KEEP LAST SELECTED CHOICES
    }
    $sendRequest = mysqli_query($conn, $query);
    $songsList = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
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
        include_once 'navbar.php'
    ?>
    <h1>Songs</h1>
    <h2>List of songs</h2>
    <form name="list" method="POST">
        <label for="selectId">Show by</label>
        <select name="select" id="selectId" value="<?= $selectedVal?>">
            <option value="artists.name">Artists Name</option>
            <option value="title">Songs Name</option>
        </select>
        <input type="submit" name="sort" value="Sort By">
    </form>
    <?php foreach($songsList as $song) : ?>
        <h2><?= $song['title']?></h2>
        <span>Artist  : <?= $song['name']?></span><br>
        <span>Released date  : <?= $song['release_date']?></span><br>
    <?php endforeach;?>

</body>
</html>