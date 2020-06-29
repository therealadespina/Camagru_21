<?php
  if ($_GET['err']) {
      echo '<script>alert("'.htmlentities($_GET['err']).'");window.location.href = "changem.php";</script>';
  }
  $title = "Camagru - Change E-mail";
  include_once 'header.php';
?>

<div class="center">
  <div class="login">
    <form action="server/changemail.php" method="post">
      <label>E-mail</label>
      <input class="input" type="email" placeholder="Enter new E-mail" name="mail" required autofocus="autofocus" tabindex="1">
      <button type="submit" class="button" tabindex="4">Change your E-mail</button>
    </form>
  </div>
</div>
<?php include_once "footer.php"; ?>