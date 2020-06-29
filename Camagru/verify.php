<?php

  header('Location: index.php');
  include_once 'config/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE mail = :mail AND state = :hash');
      $sth->bindParam(':mail', $_GET['email'], PDO::PARAM_STR);
      $sth->bindParam(':hash', $_GET['hash'], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
  if ($sth->fetchColumn()) {
      try {
          $sth = $dbh->prepare("UPDATE users SET state = 'active' WHERE mail = :mail AND state = :hash");
          $sth->bindParam(':mail', $_GET['email'], PDO::PARAM_STR);
          $sth->bindParam(':hash', $_GET['hash'], PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo 'Error: '.$e->getMessage();
          exit;
      }

      header("Location: index.php?err=Your account is now valid. You can login.\n");
  } else {
      header("Location: index.php?err=Error.\n");
  }