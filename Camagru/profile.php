<?php
  if ($_GET['err']){echo "<script>alert(\"".htmlentities($_GET['err'])."\");window.location.href = \"profile.php\";</script>";}
  $title = "Camagru - Profile";
  include_once "header.php";
  include_once 'config/database.php';
?>

    <?php
    if (!isset($_SESSION))
    session_start();
    if ($_SESSION['Username'] && !empty($_SESSION['Username'])):
  
   $login = $_SESSION['Username'];
   $testing="";
   $testing.="<div class='center2'>";
   $testing.="<h3 class='h33'>".$_SESSION['Username']."</h3>";
   $testing.="<div class='login2'>
         <form action='changem.php'><button type='submit' class='button'>Change E-mail</button></form>
         <form action='change.php'><button type='submit' class='button'>Change name</button></form>
         <form action='forgot_u.php'><button type='submit' class='button'>Change password</button></form>";

         
         $dbh->query("use Camagru");
         
         try{
          $sth = $dbh->prepare("SELECT notific FROM users WHERE login = ?");
          $sth->execute(array($login));
          }catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
          exit;
          }

        $result = $sth->fetchAll();
        $test = $result[0]['notific'];
        $superresult = $test == 1 ? "<form action='server/notifications.php'><button type='submit' class='button notific_yes'>Notifications</button></form>" : "<form action='server/notifications.php'><button type='submit' class='button notific_no'>Notifications</button></form>";

             $testing.=$superresult."<form action='server/disconnect.php' method='post'>
             <button type='submit' class='button'>Logout</button>
           </form>
     </div>
   </div>";

    echo $testing;

  ?>
    <?php endif; ?>
    <?php include_once "footer.php"; ?>