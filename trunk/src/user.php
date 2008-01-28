<?php

include_once "include/Prepare.php";

include_once "controller/action/UserAction.php";

$action = new UserAction();

if (isset($_GET["register"])) {
	$result = $action->save();
	
	print_r($result);
	
	if ($result != null) {
//		header("Location: user-setting.php");
	} else {
//		echo "Error...";
		$flash = array();
		$flash['error'] = '注册用户时产生错误，请重新注册。<a href="login.php">注册</a>';
		include 'error.php';
		
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
//	echo json_encode($result->toJSONObject());
	header("Location: user-setting.php");
} else if (isset($_GET["bindFF"])) {
	$result = $action->bindAccount("ff");
//	echo json_encode($result->toJSONObject());
	header("Location: user-setting.php");
}
?>