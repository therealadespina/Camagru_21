<?php
  header('Location: ../index.php');
  include_once '../config/database.php';

  if (empty($_POST['login']) || empty($_POST['passwd']) || empty($_POST['passwd2']) || empty($_POST['email']) || empty($_POST['hash'])) {
      header("Location: ../index.php?err=Please fill in all the blanks.\n");
      exit();
  }
  if ($_POST['passwd'] != $_POST['passwd2']) {
      header("Location: ../index.php?err=Passwords do not match.\n");
      exit();
  }

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
  
  if (!$sth->fetchColumn()) {
      header("Location: ../index.php?err=Account does not exist.\n");
      exit();
  }
  $passwd = hash('SHA256', $_POST['passwd']);

  try {
      $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE login = :login AND mail = :email AND forgot = :hash');
      $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
      $sth->bindParam(':hash', $_POST['hash'], PDO::PARAM_STR);
      $sth->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  if ($sth->fetchColumn()) {
      try {
          $sth = $dbh->prepare("UPDATE users SET forgot = 'NULL', passwd = :passwd WHERE login = :login AND mail = :email AND forgot = :hash");
          $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
          $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
          $sth->bindParam(':hash', $_POST['hash'], PDO::PARAM_STR);
          $sth->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo 'Error: '.$e->getMessage();
          exit;
      }

      header("Location: ../index.php?err=Your password has been correctly changed.\n");
  } else {
      header("Location: ../index.php?err=Error.\n");
  }
