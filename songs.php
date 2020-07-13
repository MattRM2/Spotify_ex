<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
$conn->set_charset("utf8");

if ($conn) {
    if (isset($_POST['select'])) {
        $selectedVal = $_POST['select'];
        $query = "SELECT * FROM songs ORDER BY $selectedVal";
    }else{
        $query = "SELECT * FROM songs ORDER BY artist_id";
    }
    $sendRequest = mysqli_query($conn, $query);
    $songsList = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
    mysqli_close($conn);

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
    <h1>Songs</h1>
    <h2>List of songs</h2>
    <form name="list" method="POST">
        <label for="selectId">Show by</label>
        <select name="select" id="selectId">
            <option value="artist_id">Artists Name</option>
            <option value="title">Songs Name</option>
        </select>
        <input type="submit" name="sort" value="Sort By">
    </form>

</body>
</html>