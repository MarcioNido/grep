<?php
header("Content-type: image/jpeg");
$img = imagecreatefromjpeg('/var/www/images/email_header_logo.jpg');
imagejpeg($img,NULL,99);
imagedestroy($img);