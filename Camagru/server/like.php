<?php
 if (!isset($_SESSION))
 session_start();
  if (!$_SESSION['Username'] || empty($_SESSION['Username'])) {
      header('Location: index.php?err=You must log in to access this page.');
      exit();
  }
  include_once '../config/database.php';
  header("Location: ../gallery.php?page=$_GET[page]");
  if (empty($_GET['img_id'])) {
      header("Location: ../gallery.php?err=Please fill in all the blanks.\n");
      exit();
  }
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT COUNT(*) FROM likes WHERE login = :login AND img_id = :img_id');
      $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
      $sth->bindParam(':login', $_SESSION['Username'], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
  if ($sth->fetchColumn()) {
      try {
          $sth = $dbh->prepare('DELETE FROM likes WHERE login = :login AND img_id = :img_id');
          $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
          $sth->bindParam(':login', $_SESSION['Username'], PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo 'Error: '.$e->getMessage();
          exit;
      }
  } else {
      try {
          $sth = $dbh->prepare('INSERT INTO likes (login, img_id) VALUES  (:login, :img_id)');
          $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
          $sth->bindParam(':login', $_SESSION['Username'], PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo 'Error: '.$e->getMessage();
          exit;
      }
  }
