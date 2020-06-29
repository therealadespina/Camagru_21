<?php

header('Location: ../profile.php');
include_once '../config/database.php';
if (!isset($_SESSION))
    session_start();

$login = $_SESSION['Username'];

$DB = explode(';', $DB_DSN);
$database = substr($DB[1], 7);
$dbh = new PDO("$DB[0]", $DB_USER, $DB_PASSWORD);
$dbh->query("use Camagru");

if ($dbh)
{
    try{
        $sth = $dbh->prepare("SELECT notific FROM users WHERE login = '$login'");
        $sth->execute(array($login));
    }catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        exit;
    }

    $result = $sth->fetch()['notific'];
    $superresult = $result == 1 ? 0 : 1;

    try {
        $sth = $dbh->prepare("UPDATE users SET notific = '$superresult' WHERE login = '$login'");
        $sth->execute(array());
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        exit;
    }
} else {
    header("Location: ../profile.php?err=Error.\n");
}