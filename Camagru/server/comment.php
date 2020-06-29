<?php
  if (!isset($_SESSION))
  session_start();
  if (!$_SESSION['Username'] || empty($_SESSION['Username'])) {
      header('Location: index.php?err=You must log in to access this page.');
      exit();
  }
  if (empty($_POST['comment']) || empty($_GET['img_id'])) {
      header("Location: ../gallery.php?page=$_GET[page]");
      exit();
  }
  include_once '../config/database.php';
  header("Location: ../gallery.php?page=$_GET[page]");

  $comment = trim($_POST['comment']);
  $comment = stripslashes($comment);
	$comment = strip_tags($comment);
	$comment = htmlspecialchars($comment);
	$comment = addslashes($comment);

  try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('INSERT INTO comments (login, img_id, comment) VALUES (:login, :img_id, :comment)');
    $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
    $sth->bindParam(':login', $_SESSION['Username'], PDO::PARAM_STR);
    $sth->bindParam(':comment', $comment, PDO::PARAM_STR);
    $sth->execute();
    $sth = $dbh->prepare('SELECT users.mail FROM users INNER JOIN snap ON users.login = snap.login WHERE snap.id = :img_id AND notific = "1"');
    $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
    $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  $mail = $sth->fetchColumn();
  $to = $mail;
  $subject = 'Camagru | New comment';
  $message = "
  A new comment has been posted on your photo by : $_SESSION[Username]

  Comment : $_POST[comment]";

  $headers = 'From:adespina@student.21-school.ru'."\r\n";
  mail($to, $subject, $message, $headers);
