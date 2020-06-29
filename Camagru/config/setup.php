<?php

  include_once 'database.php';

try {
    $dbh->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "Database '$database' created successfully.<br>";
    $dbh->exec("use $database");
    $dbh->exec("CREATE TABLE IF NOT EXISTS users (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  mail VARCHAR(255) NOT NULL,
                                                  passwd VARCHAR(255) NOT NULL,
                                                  state VARCHAR(255) NOT NULL,
                                                  forgot VARCHAR(255) NOT NULL,
                                                  notific VARCHAR(5) NOT NULL)");
    echo "Table 'users' created successfully.<br>";
    $dbh->exec("CREATE TABLE IF NOT EXISTS snap  (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  img VARCHAR(255) NOT NULL)");
    echo "Table 'snap' created successfully.<br>";
    $dbh->exec("CREATE TABLE IF NOT EXISTS comments  (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  img_id VARCHAR(255) NOT NULL,
                                                  comment VARCHAR (255) NOT NULL)");
    echo "Table 'comments' created successfully.<br>";
    $dbh->exec("CREATE TABLE IF NOT EXISTS likes  (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  img_id VARCHAR(255) NOT NULL)");
    echo "Table 'likes' created successfully.<br>";
} catch (PDOException $e) {
    echo $sql.'<br>'.$e->getMessage();
}

  $dbh = null;
?>