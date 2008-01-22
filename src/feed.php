<?php
include_once "include/Prepare.php";

include_once "controller/action/DiggItemAction.php";

$action = new DiggItemAction();
$feed = $action->feed();

echo $feed;
?>