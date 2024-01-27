<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$img_path = $protocol.$_SERVER["HTTP_HOST"]."/img/logo.png";
echo "<br>";
echo $_SERVER["HTTP_HOST"];
echo "<br>";
echo $img_path;
echo phpinfo();
?>