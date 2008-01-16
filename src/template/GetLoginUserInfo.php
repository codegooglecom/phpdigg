<?php
include_once "include/Prepare.php";

include_once "controller/action/UserAction.php";

$action = new UserAction();
$user = $action->getLoginUser();

?>