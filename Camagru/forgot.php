<?php
  if ($_GET['err']) {
      echo '<script>alert("'.htmlentities($_GET['err']).'");window.location.href = "forgot.php";</script>';
  }
  include_once 'header.php';
?>
<title>Camagru | Change password</title>
<div class="center">
    <form class="login" action="server/changepass.php" method="post">
      <label>Submit Username</label>
      <input class="input" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

      <label> New Password</label>
      <input class="input" type="password" placeholder="Enter Password" name="passwd" required tabindex="2" required pattern="^[0-9a-zA-Z]+$" minlength="8" maxlength="12" required>

      <label>Retype new password</label>
      <input class="input" type="password" placeholder="Retype Password" name="passwd2" required tabindex="3" required pattern="^[0-9a-zA-Z]+$" minlength="8" maxlength="12" required>
      <?php if ($_GET['hash'] && $_GET['email']): ?>
        <input type='hidden' name='email' value='<?=$_GET['email']?>'>
        <input type='hidden' name='hash' value='<?=$_GET['hash']?>'>
      <?php endif; ?>
      <button type="submit" class="button" tabindex="4">Change your password</button>
    </form>
</div>
      </div>
      <?php include_once "footer.php"; ?>
