<?php

if (!isset($_SESSION))
    session_start();

        include_once 'config/database.php';
        $start = number_format($_GET['page']);

        try {
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $dbh->prepare('SELECT * FROM snap');
            $sth->bindParam(':start', $start, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
            exit;
        }
        $result = $sth->fetchAll();
        $result = array_reverse($result);

        $photo_on_page = 6;
        $count = count($result);

        $photos_per_page = ceil($count / $photo_on_page);
        $first_photo_index = $start == 1 ? 0 : ($start-1) * $photo_on_page;
        $photos_splice = array_splice($result, $first_photo_index, $photo_on_page);
        
        $title = "Camagru - Gallery";
        include_once 'header.php';
        ?>

        <?php
        $testing = "<div class='container'>";
        foreach ($photos_splice as $key => $value) {
            $pos = "";
            $pos.="<div class='fleximgbox'>";
            try {
                $sth = $dbh->prepare('SELECT COUNT(*) FROM likes WHERE img_id = :img_id');
                $sth->bindParam(':img_id', $value['id'], PDO::PARAM_INT);
                $sth->execute();
            } catch (PDOException $e) {
                echo 'Error: '.$e->getMessage();
                exit;
            }
            
            $likes = $sth->fetchColumn();
            $today = date("m.d.y");

            if ($value['login'] == $_SESSION['Username']) {
                $pos.= "<a href='server/remove_img.php?img=$value[id]&page=$_GET[page]'><img src='images/Delete.png' width='27' style='position:absolute;'></a>";
            }

            $pos.= "<img src='$value[img]' style='width:430px; border-radius:7px;'>
            <br/>
            <div class='user'>User: $value[login]</div>
            $today
            <br/>
            Likes: $likes";

            if ($_SESSION['Username'])
            {
                $pos.= "<a href='server/like.php?img_id=$value[id]&page=$_GET[page]' style='float:right; margin-top: -20px;'>
                <img src='images/Like.gif' width='30' height='30'></a>
                <form class='comment' action='server/comment.php?img_id=$value[id]&page=$_GET[page]' method='post'>
                <br/>
                <input class='input' style='width:100%;' type='text' placeholder='Enter your comment' name='comment' required>
                <button type='submit' class='button'>Send</button>
                </form>
                <form action='server/download_photo.php?img=$value[img]'><button type='submit' class='button2'>Save photo</button>
                <input type='hidden' name='img' value='$value[img]'>
                </form>";
            
                try {
                    $sth = $dbh->prepare("SELECT * FROM comments WHERE img_id = $value[id]");
                    $sth->execute();
                } catch (PDOException $e) {
                    echo 'Error: '.$e->getMessage();
                    exit;
                }
                $result = $sth->fetchAll();
                if ($result) {
                    $pos.= "<div class='comments'>";
                    foreach ($result as $key => $value) {
                        $pos.= "○ $value[login] <br/> $value[comment] <hr>";
                    }
                    $pos.= '</div>';
                }   
            }
            
        $pos.= '</div>';
        $testing.=$pos;
        }
        echo $testing;
        echo '</div><center><ul>';

        try {
            $sth = $dbh->prepare('SELECT COUNT(*) FROM snap');
            $sth->execute();
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
            exit;
        }
        
        $prev = $_GET['page'] - 1;
        if ($prev > 0) {
            echo "<li><a href='gallery.php?page=$prev'>«</a></li>";
        }
        for ($i = 1; $i <= $photos_per_page; ++$i) {
            echo "<li><a href='gallery.php?page=$i'>$i</a></li>";
        }
        $next = $_GET['page'] + 1;
        if ($next < $photos_per_page) {
            echo "<li><a href='gallery.php?page=$next'>»</a></li>";
        }
        echo '</ul></center>';
        ?>

    </div>