<?php
session_start();

//*DECLARE VAR
$msg = '';

include_once('database.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);

if ($conn && !empty((isset($_SESSION['idUser'])))) {
    $id = explode('-', $_SESSION['idUser']);
    $id = $id[1]; //? [0] = email, [1] = user_id
    $query = "SELECT * FROM users WHERE user_id=$id";
    $sendRequest = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($sendRequest);
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
    <title>Spotify Exercice Account</title>
</head>
<body>
    <?php
        include_once 'navbar.php'
    ?>
    <h1>Your profile</h1>
    <span>First Name : <?= $user['first_name']?></span><br>
    <span>Last Name : <?= $user['last_name']?></span><br>
    <span>Email : <?= $user['mail']?></span><br>
</body>
</html>