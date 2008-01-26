<?php

include_once "include/Prepare.php";

include_once "controller/action/UserAction.php";

$action = new UserAction();

if (isset($_GET["register"])) {
	$result = $action->save();
	
	if ($result != null) {
		header("Location: default.php");
	} else {
		echo "Error...";
	}
//	echo json_encode($result);
} else if (isset($_GET["login"])) {
	$result = $action->login();
	
	if (isset($_GET["json"])) {
		$jsonResult = array (
			"result" => ($result != null)
		);
		
		echo json_encode($jsonResult);
	} else {
		if ($result != null) {
			header("Location: default.php");
		} else {
			echo "Username or password wrong.";
		}
	}
	
//	echo json_encode($result);
} else if (isset($_GET["logout"])) {
	$result = $action->logout();
	
	header("Location: default.php");
} else if (isset($_GET["avator"])) {
	$result = $action->updateAvator();
	
	header("Location: default.php");
} else if (isset($_GET["password"])) {
	$result = $action->changePassword();
	
	echo json_encode($result);
	//header("Location: default.php");
} else if (isset($_GET["profile"])) {
	$result = $action->updateProfile();
	
	//echo json_encode($result->toJSONObject());
	header("Location: user-setting.php");
}
?>