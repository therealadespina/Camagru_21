<?php
header('Location: ../index.php');
include_once '../config/database.php';
if (!isset($_SESSION))
    session_start();
if (empty($_POST['login'])) {
    header("Location: ../index.php?err=Please fill in all the blanks.\n");
    exit();
}

$login = $_POST['login'];
$oldlogin = $_SESSION['Username'];

try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
    $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
    $sth->execute();
} catch (PDOException $e) {
    echo 'Error: '.$e->getMessage();
    exit;
}

if ($sth->fetchColumn()) {
    header("Location: ../change.php?err=Login already taken.\n");
    exit();
}

if ($dbh) {
    try {

        $sth = $dbh->prepare("UPDATE users SET login = ? WHERE login = ?");
        $sth->execute(array($login, $oldlogin));
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        exit;
    }
    $_SESSION['Username'] = $login;
    header("Location: ../index.php?err=Your login has been correctly changed.\n");
} else {
    header("Location: ../index.php?err=Error.\n");
}