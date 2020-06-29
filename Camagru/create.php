<?php
  if ($_GET['err']){echo "<script>alert(\"".htmlentities($_GET['err'])."\");window.location.href = \"create.php\";</script>";}
  $title = "Camagru | Create account";
  include_once 'header.php';
?>

<div class="center">
    <form class="login" action="server/creation.php" method="post">
      <label>Username*</label>
      <input class="input" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1" required pattern="^[0-9a-zA-Z]+$" minlength="5" maxlength="10" required>

      <label>E-mail adress</label>
      <input class="input" type="email" placeholder="Enter E-mail" name="mail" required tabindex="2" required>

    
        <label><p data-tooltip="Only sign and latin alphabet! By Odin, by Thor!">Password*</p></label>
        <input class="input" type="password" placeholder="Enter Password" name="passwd" required tabindex="3" required pattern="^[0-9a-zA-Z]+$" minlength="8" maxlength="12" required>
      

      <label>Retype password</label>
      <input class="input" type="password" placeholder="Retype Password" name="passwd2" required tabindex="4" required pattern="^[0-9a-zA-Z]+$" minlength="8" maxlength="12" required>

      <button type="submit" class="button" tabindex="5">Create your account</button>
    </form>
</div>
<?php include_once "footer.php"; ?>