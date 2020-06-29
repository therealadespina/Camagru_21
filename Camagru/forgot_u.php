<?php
  if ($_GET['err']){echo "<script>alert(\"".htmlentities($_GET['err'])."\");window.location.href = \"forgot_u.php\";</script>";}
  $title = "Camagru - Change password";
  include_once 'header.php';
?>

<div class="center">
    <form class="login" action="server/reset.php" method="post">
      <label>Username</label>
      <input class="input" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">
      <button type="submit" class="button" tabindex="2">Reset your password</button>
    </form>
</div>
<?php include_once "footer.php"; ?>