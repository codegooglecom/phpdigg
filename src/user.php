<?php

include_once "include/Prepare.php";

include_once "controller/action/UserAction.php";

$action = new UserAction();

if (isset($_GET["register"])) {
	$result = $action->save();
	
	if ($result != null) {
		header("Location: default.php");
	} else {
		echo "Username or password wrong.";
	}
//	echo json_encode($result);
} else if (isset($_GET["login"])) {
	$result = $action->login();
	
	if ($result != null) {
		header("Location: default.php");
	} else {
		echo "Username or password wrong.";
	}
//	echo json_encode($result);
} else if (isset($_GET["logout"])) {
	$result = $action->logout();
	
	header("Location: default.php");
}
?>