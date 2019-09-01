<?php

$url = explode('index.php', $_SERVER['PHP_SELF']);
$url = explode('/', $url[1]);
array_shift($url);
array_shift($url);

$custom = new Gallery();
$custom = $custom->oi();
?>