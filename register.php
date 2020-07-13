<?php

//* DECLARE VAR
$error = array('first_name'=>'','last_name'=>'','email'=>'','password'=>'');
$connFail = '';
$first_nameVal = '';
$last_nameVal = '';
$emailVal = '';
$passVal = '';
$msg = '';

//* PUSH THE BOUTON
if (isset($_POST['register'])) {
    //* GET THE first name AND VALIDATE IT
    if (!empty($_POST['first_name'])) {
        $first_name = strip_tags($_POST['first_name']);
        $first_name = htmlspecialchars($first_name);
        $first_nameVal = $first_name;
    }else{
        $error['first_name'] = 'You need to put your first name';
    }
    //* GET THE last name AND VALIDATE IT
    if (!empty($_POST['last_name'])) {
        $last_name = strip_tags($_POST['last_name']);
        $last_name = htmlspecialchars($last_name);
        $last_nameVal = $last_name;
    }else{
        $error['last_name'] = 'You need to put your last name';
    }
    //* GET THE EMAIL AND VALIDATE IT
    if (!empty($_POST['email'])) {
        //TODO TOUJOURS CLEANER LE MAIL COMME LA !!!!!
        $cleanEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $cleanEmail = filter_var($cleanEmail, FILTER_VALIDATE_EMAIL);
        $cleanEmail = htmlspecialchars($cleanEmail);
        $cleanEmail = strip_tags($cleanEmail);
        if ($cleanEmail) {
            $email = trim($cleanEmail);
            $emailVal = $email;
        }else{
            $error['email'] = 'You need to put a valid email';
        }
    }else{
        $error['email'] = 'You need to put an email';
    }
    //* GET THE PASSWORD AND VALIDATE IT
    if (!empty($_POST['password'])) {
        $password = trim($_POST['password']);
        $password = htmlspecialchars($password);
        $password = strip_tags($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
    }else{
        $error['password'] = 'You need to put a password';
    }
    //* SEND THE DATAS
    if (empty($error['first_name']) && empty($error['last_name']) && empty($error['email']) && empty($error['password'])) {
        include_once('database.php');
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'spotify_ex', '3306');

        //TODO Make sure email is not already taken
        $checkQuery = "SELECT * FROM users WHERE mail='$email'";
        $ResCheckQuery = mysqli_query($conn, $checkQuery);
        $count = mysqli_num_rows($ResCheckQuery);

        if (!$count > 0) {
            $query = "INSERT INTO users (first_name, last_name, mail, password) VALUE ('$first_name', '$last_name', '$email', '$password')";
            mysqli_query($conn, $query);
            mysqli_close($conn);
            //* TO BE CLEAN RESET ALL DATAS
            $connFail = '';
            $first_nameVal = '';
            $last_nameVal = '';
            $emailVal = '';
            $passVal = '';
            $msg = '<div>Registration completed<a href="login.php">, Click here to login</a></div>';
        }elseif($count > 0){
            $msg = 'The mail is already use';
        }elseif(!$conn){
            $msg = 'Problem to connect to the server, try again or contact us';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Exercice Register</title>
</head>
<body>
    <form method="POST">
        <?php
            include_once 'navbar.html'
        ?>
        <br>
        <input type="text" name="first_name" placeholder="First name" value="<?= $first_nameVal?>"><span style="font-weight:red;color:red"><?= $error['first_name']?></span><br>
        <input type="text" name="last_name" placeholder="Last Name" value="<?= $last_nameVal?>"><span style="font-weight:red;color:red"><?= $error['last_name']?></span><br>
        <input type="email" name="email" placeholder="email" value="<?= $emailVal?>"><span style="font-weight:red;color:red"><?= $error['email']?></span><br>
        <input type="password" name="password" placeholder="Your password"><span style="font-weight:red;color:red"><?= $error['password']?></span><br>
        <input type="submit" name="register" value="Register"><br>
        <?= $msg?>
    </form>
</body>
</html>