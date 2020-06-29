<?php
  header("Location: ../gallery.php?page=$_GET[page]");
  session_start();
  include_once '../config/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('DELETE FROM comments WHERE login = :login AND id = :comment');
      $sth->bindParam(':login', $_SESSION['Username'], PDO::PARAM_STR);
      $sth->bindParam(':comment', $_GET['img'], PDO::PARAM_INT);
      $sth->execute();
  } catch (PDOException $e) {
      echo $sql.'<br>'.$e->getMessage();
  }