<?php
  if (!isset($_SESSION))
  session_start();
  header('Location: ../index.php');
  include_once '../config/database.php';

  if (empty($_POST['login']) || empty($_POST['passwd'])) {
      header("Location: ../index.php?err=Please fill in all the blanks.\n");
      exit();
  }
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
      $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo $sql.'<br>'.$e->getMessage();
  }
  if ($user = $sth->fetchColumn()) {
      try {
          $passwd = hash('SHA256', $_POST['passwd']);
          $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE passwd = :passwd AND login = :login');
          $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
          $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo $sql.'<br>'.$e->getMessage();
      }
      if ($sth->fetchColumn()) {
          try {
              $sth = $dbh->prepare("SELECT COUNT(*) FROM users WHERE passwd = :passwd AND login = :login AND state = 'active'");
              $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
              $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
              $sth->execute();
          } catch (PDOException $e) {
              echo $sql.'<br>'.$e->getMessage();
          }
          if ($sth->fetchColumn()) {
              $_SESSION['Username'] = $_POST['login'];
              exit();
          } else {
              header("Location: ../index.php?err=Activate your account.\n");
          }
      } else {
          header("Location: ../index.php?err=Bad password.\n");
          exit();
      }
  } else {
      header("Location: ../index.php?err=Account does not exist.\n");
      exit();
  }
