<?php
function download_photo($new_file)
{
	if ( file_exists($new_file)) {
		if (ob_get_level()) {
			ob_end_clean();
        }
		header("Pragma: public"); 
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false); // нужен для некоторых браузеров
	header("Content-Type: $new_file");
	header("Content-Disposition: attachment; filename=\"".basename($new_file)."\";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($new_file)); // необходимо доделать подсчет размера файла по абсолютному пути
	readfile("$new_file");
	exit();
    }
}

    if (isset($_GET))
{
    $file = "../".$_GET['img'];
    download_photo($file);
}