<?php
session_start();

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if ($conn) {
    echo 'hello';
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
    
</body>
</html>