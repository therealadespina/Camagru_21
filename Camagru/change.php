<?php
  if ($_GET['err']) {
      echo '<script>alert("'.htmlentities($_GET['err']).'");window.location.href = "change.php";</script>';
  }
  $title = "Camagru - Change name";
  include_once 'header.php';
?>

<div class="center">
  <div class="login">
    <form action="server/changename.php" method="post">
      <label>Username</label>
      <input class="input" type="text" placeholder="Enter new Username" name="login" required autofocus="autofocus" tabindex="1">
      <button type="submit" class="button" tabindex="4">Change your Name</button>
    </form>
  </div>
</div>
<?php include_once "footer.php"; ?>