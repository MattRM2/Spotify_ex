<?php
session_start();

//* DECLARE VAR
$error = array('email'=>'', 'password'=>'');
$logOk = false;
$msg = '';
$emailVal = '';
// $passwordVal = '';

if (isset($_POST['register'])) {
    header("location: register.php");
    exit();
}

if (isset($_POST['login'])) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        $email = strip_tags($email);
        $emailVal = $email;
    }else{
        $error['email']='You need to put an email';
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $password = htmlspecialchars($password);
        $password = strip_tags($password);
    }else{
        $error['password']='You need to put a password';
    }
    //* ASK THE DATAS
    if (empty($error['email']) && empty($error['password'])) {
        include_once('database.php');
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATA, DB_PORT);
        if ($conn) {
            $query = "SELECT * FROM users";
            $sendRequest = mysqli_query($conn, $query);
            $users = mysqli_fetch_all($sendRequest, MYSQLI_ASSOC);
            mysqli_close($conn);
        }else{
            $msg = "Connection to the server failed, contact us if the problem persist";
        }

        //* FOUND THE USER
        foreach ($users as $user) {
            if ($email === $user['mail'] && password_verify($password, $user['password'])) {
                $logOk = true;
            break;
            }
        }
        if ($logOk) {
            $msg = "You're logged !!!!";
            $idUserKey = $email.'-'.$user['user_id'];
            if (!isset($_SESSION['idUser'])) {
                $_SESSION['idUser'] = $idUserKey;
                $emailVal = '';
                $msg = "You are logged";
                header("location: account.php");
                exit();
            }
        }else{
            $msg = "Login Failed, check your informations";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Exercice Login</title>
</head>
<body>
    <?php
        include_once 'navbar.php'
    ?>
    <form method="POST">
        <input type="email" name="email" placeholder="email" value="<?= $emailVal?>"><span style="font-weight:bold;color:red"><?= $error['email']?></span><br>
        <input type="password" name="password" placeholder="password"><span style="font-weight:bold;color:red"><?= $error['password']?></span><br>
        <input type="submit" name="login" value="Login">
    </form>
    <?= $msg?>
</body>
</html>