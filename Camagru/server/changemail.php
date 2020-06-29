<?php
header('Location: ../index.php');
include_once '../config/database.php';
if (!isset($_SESSION))
    session_start();
if (empty($_POST['mail'])) {
    header("Location: ../index.php?err=Please fill in all the blanks.\n");
    exit();
}

$newmail = $_POST['mail'];
$login = $_SESSION['Username'];

try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE mail = :mail');
    $sth->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
    $sth->execute();
} catch (PDOException $e) {
    echo 'Error: '.$e->getMessage();
    exit;
}

if ($sth->fetchColumn()) {
    header("Location: ../changem.php?err=E-mail already taken.\n");
    exit();
}

if ($dbh)
{
    try{
        $sth = $dbh->prepare("SELECT mail FROM users WHERE login = '$login'");
        $sth->execute(array($oldmail));
    }catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        exit;
    }

    try {
        $sth = $dbh->prepare("UPDATE users SET mail = '$newmail' WHERE login = '$login'");
        $sth->execute(array($newmail, $oldmail));
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        exit;
    }
    header("Location: ../index.php?err=Your E-mail has been correctly changed.\n");
} else {
    header("Location: ../index.php?err=Error.\n");
}