<?php

  header('Location: ../index.php');
  include_once '../config/database.php';

  if ($_POST['passwd'] != $_POST['passwd2']) {
    header("Location: ../create.php?err=Passwords do not match.\n");
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

  if ($sth->fetchColumn()) {
      header("Location: ../create.php?err=Login already taken.\n");
      exit();
  }

  $passwd = hash('SHA256', $_POST['passwd']);
  $hash = md5(rand(0, 1000));
  $forgot = md5(rand(0, 1000));
  $notific = "1";

  try {
      $sth = $dbh->prepare('INSERT INTO users (login, mail, passwd, state, forgot, notific) VALUES (:login, :mail, :passwd, :hash, :forgot, :notific)');
      $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
      $sth->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
      $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
      $sth->bindParam(':hash', $hash, PDO::PARAM_STR);
      $sth->bindParam(':forgot', $forgot, PDO::PARAM_STR);
      $sth->bindParam(':notific', $notific, PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  $username = $_POST['login'];
  $user_password = $_POST['passwd'];
  $user_email = $_POST['mail'];
  
  $to = $user_email;
  $subject = 'Camagru | Registration';
  $message = "
  Hi this is Camagru team! Your account has been created, you can log in with the following identifier after activating your account!

  Username: $username
  Password: $user_password
  Email: $user_email
  
  Click on the following link to activate your account http://localhost:8080/verify.php?email=$user_email&hash=$hash";

  $headers = 'From:adespina@student.21-school.ru'."\r\n";

  $res = mail($to, $subject, $message, $headers);
    if ($res === TRUE){
        header("Location: ../index.php?err=Your account was created. Please activate it with the link sent to your email.\n");
    }
    else{
        echo "Error";
    }