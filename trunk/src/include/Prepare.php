<?php
$dpath = dirname(__FILE__);

$path = get_include_path();
//$newPath = $path . PATH_SEPARATOR . $dpath;
$newPath = "." . PATH_SEPARATOR . $dpath;
set_include_path($newPath);

ini_set("date.timezone", "Asia/Shanghai");

?>