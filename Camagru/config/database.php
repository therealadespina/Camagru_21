<?php
  $DB_DSN = 'mysql:host=127.0.0.1;dbname=Camagru';
  $DB_USER = 'adespina';
  $DB_PASSWORD = '123';
  $DB = explode(';', $DB_DSN);
  $database = substr($DB[1], 7);
  $dbh = new PDO("$DB[0]", $DB_USER, $DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
