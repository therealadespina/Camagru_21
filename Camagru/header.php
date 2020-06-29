<?php
    if (!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/camagru.css" />
    <title><?php echo $title;?></title>
</head>
    <header>
        <div>
            <a href="index.php" class="camagru">Camagru</a>
        </div>
        <div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="camera.php">Camera</a></li>
                <li><a href="gallery.php?page=1">Gallery</a></li>
                <li><a href="about.php">About</a></li>
                <?php if ($_SESSION['Username'] && !empty($_SESSION['Username'])): ?>
                <li><a href='server/disconnect.php'>Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    