<?php
  if (!isset($_SESSION))
  session_start();
  if ($_SESSION['Username'] && !empty($_SESSION['Username'])) {
      $title = "Camagru - Camera";
      include_once 'header.php';
  } else {
      header('Location: index.php?err=You must log in to access this page.');
  }
?>
<script src="js/webcam.js" charset="utf-8"></script>

<div class="videobox">
  <h3>Live</h3>

  <video id="video" autoplay></video>
  
  <img id="image" height="640px" width="480px" style="display: none;"/>
  <div id="canvasVideo"></div>
  <center>
    <button onclick="plus()" class="button" style="width: 70px;">+</button>
    <button onclick="minus()" class="button" style="width: 70px;">-</button>
  </center>

  <div class="filters">
      <form id="img_filter">

        <label for="21">
          <input type="checkbox" name="img_filter" value="images/filters/21.png" id="21" onchange="show_img('21')">
          <img class="img" src="images/filters/21.png" height="70" width="70">
        </label>

        <label for="cat">
          <input type="checkbox" name="img_filter" value="images/filters/cat.png" id="cat" onchange="show_img('cat')">
          <img class="img" src="images/filters/cat.png" height="70" width="70">
        </label>

        <label for="coachella">
          <input type="checkbox" name="img_filter" value="images/filters/coachella.png" id="coachella" onchange="show_img('coachella')">
          <img class="img" src="images/filters/coachella.png" height="70" width="70">
        </label>

        <label for="coder">
          <input type="checkbox" name="img_filter" value="images/filters/coder.png" id="coder" onchange="show_img('coder')">
          <img class="img" src="images/filters/coder.png" height="70" width="70">
        </label>

        <label for="sezam1">
          <input type="checkbox" name="img_filter" value="images/filters/sezam1.png" id="sezam1" onchange="show_img('sezam1')">
          <img class="img" src="images/filters/sezam1.png" height="70" width="70">
        </label>

        <label for="sezam2">
          <input type="checkbox" name="img_filter" value="images/filters/sezam2.png" id="sezam2" onchange="show_img('sezam2')">
          <img class="img" src="images/filters/sezam2.png" height="70" width="70">
        </label>

        <label for="glasses">
        <input type="checkbox" name="img_filter" value="images/filters/glasses.png" id="glasses" onchange="show_img('glasses')">
        <img class="img" src="images/filters/glasses.png" height="70" width="70">
        </label>

        <label for="labaf">
          <input type="checkbox" name="img_filter" value="images/filters/labaf.png" id="labaf" onchange="show_img('labaf')">
          <img class="img" src="images/filters/labaf.png" height="70" width="70">
        </label>

        <br/>
        <label for="life">
          <input type="checkbox" name="img_filter" value="images/filters/life.png" id="life" onchange="show_img('life')">
          <img class="img" src="images/filters/life.png" height="70" width="70">
        </label>

        <label for="pepe">
          <input type="checkbox" name="img_filter" value="images/filters/pepe.png" id="pepe" onchange="show_img('pepe')">
          <img class="img" src="images/filters/pepe.png" height="70" width="70">
        </label>

        <label for="stuff">
          <input type="checkbox" name="img_filter" value="images/filters/stuff.png" id="stuff" onchange="show_img('stuff')">
          <img class="img" src="images/filters/stuff.png" height="70" width="70">
        </label>

        <label for="wow">
          <input type="checkbox" name="img_filter" value="images/filters/wow.png" id="wow" onchange="show_img('wow')">
          <img class="img" src="images/filters/wow.png" height="70" width="70">
        </label>
      </form>
      <div class="snap">
        <button class="button" onclick="javascript:takeSnap()">Snap</button>
      </div>
      <input type='file' accept="image/*" onchange="readURL(this);" />
      <br/>
      <img id="image" height="640px" width="480px" style="display: none;"/>
  </div>
</div>

<div class="aftervideobox">
    <h3>Overview</h3>
    <div id="canvasPhoto"></div>
    <form method='post' accept-charset='utf-8' name='form'>
      <input name='img' id='img' type='hidden'/>
      <input name='user' id='user' type='hidden' value='<?=$_SESSION['Username'];?>'/>
    </form>
</div>
