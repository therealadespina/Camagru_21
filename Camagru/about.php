<?php
	if ($_GET['err']){echo "<script>alert(\"".htmlentities($_GET['err'])."\");window.location.href = \"about.php\";</script>";}
  
	$title = "Camagru - About";
	include_once "header.php";
?> 

<div class="about">
	<div class="about_inside"><center>Что такое CAMAGRU?</center></br>Camagru - это web приложение для обмена фотографиями с элементами социальной сети, позволяющее снимать фотографии и применять к ним фильтры.
	</div>
</div>

<?php include_once "footer.php"; ?>