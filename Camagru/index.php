<?php
	if ($_GET['err']){echo "<script>alert(\"".htmlentities($_GET['err'])."\");window.location.href = \"index.php\";</script>";}
  
	$title = "Camagru - Home";
	include_once "header.php";
?>
    <?php
    if (!isset($_SESSION))
    session_start();
    if ($_SESSION['Username'] && !empty($_SESSION['Username'])):
    ?>
    <div class="center">
      <div class="login1">
         <button type='submit' class='button' onclick="location.href = 'profile.php'">Profile</button>
        <form action='server/disconnect.php' method='post'>
          <button type='submit' class='button'>Logout</button>
        </form>
      </div>
    </div>
    <?php else: ?>
    <div class="center">
      <div class="login">
        <form action="server/login.php" method="post">
          <label>Username</label>
            <input class="input" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

          <label>Password</label>
            <input class="input" type="password" placeholder="Enter Password" name="passwd" required tabindex="2">

            <button type="submit" class="button" tabindex="4">Sign in</button>
            <a href="forgot_u.php" class="forgot">Forgot your password?</a>

          <div class="strike">New User?</div>
        </form>
        <button class="button" onclick="location.href = 'create.php'" tabindex="5">Sign up</button>
        <?php endif; ?>
      </div>
    </div>
  
<?php include_once "footer.php"; ?>
