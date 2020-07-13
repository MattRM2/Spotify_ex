<?php

?>
<nav>
    <a href="home.php">Home</a><span> | </span>
    <a href="songs.php">Songs</a><span> | </span>
    <a href="artists.php">Artists</a><span> | </span>
    <?php
        if (isset($_SESSION['idUser'])) {
            echo '<a href="playlists.php">Playlist</a><span> | </span>';
        }
        echo '';

        if (!isset($_SESSION['idUser'])) {
            echo '<a href="register.php">Register</a><span> | </span>';
        }else{
            echo '';
        }

        if (isset($_SESSION['idUser'])) {
            echo '<a href="account.php">Account</a><span> | </span>';
        }
            echo '';

        if (!isset($_SESSION['idUser'])) {
            echo '<a href="login.php">Login</a>';
        }else{
            echo '<a href="logout.php">Logout</a>';
        }
    ?>
    
</nav>