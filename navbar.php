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
            $playlist = '<a href="">Playlist</a><span> | </span>';
        }
        echo $playlist;
    ?>
    <?php
        if (!isset($_SESSION['idUser'])) {
            echo '<a href="register.php">Register</a><span> | </span>';
        }else{
            echo '';
        }
    ?>
    <?php
        if (!isset($_SESSION['idUser'])) {
            echo '<a href="login.php">Login</a><span> | </span>';
        }else{
            echo '<a href="logout.php">Logout</a><span> | </span>';
        }
    ?>
    <?php
        if (isset($_SESSION['idUser'])) {
            $account = '<a href="account.php">Account</a>';
        }
        echo $account;
    ?>
    
</nav>