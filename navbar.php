<?php
$playlist = '';
$account = '';
?>
<nav>
    <a href="home.php">Home</a><span> | </span>
    <a href="">Songs</a><span> | </span>
    <a href="">Artists</a><span> | </span>
    <?php
        if (isset($_SESSION['idUser'])) {
            $playlist = '<a href="playlist.php">Playlist</a><span> | </span>';
        }
        echo $playlist;
    ?>
    <a href="register.php">Register</a><span> | </span>
    <a href="login.php">Login</a>
    <?php
        if (isset($_SESSION['idUser'])) {
            $account = '<span> | </span><a href="account.php">Account</a>';
        }
        echo $account;
    ?>
    
</nav>