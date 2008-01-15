<?php
include_once "include/Prepare.php";

include_once "controller/action/DiggItemAction.php";

$action = new DiggItemAction();

if (isset($_GET["new"])) {
	$type = $_GET["type"];
	
	if ($type) {
		if ($type == "image") {
			$result = $action->createImageDiggItem();
			
//			echo json_encode($result);
		} else if ($type == "music") {
			$action->createMusicDiggItem();
		}
		
		header("Location: beta.php");
	} else {
		$result = $action->createDiggItem();
	
		$stff = $_POST["shareToFanfou"];
		if ($stff == "true") {
			include_once "lib/Snoopy.class.php";
			include_once "lib/Fanfou.class.php";
			$u = $_POST["ffUsername"];
			$p = $_POST["ffPassword"];
			
			$ff = new Fanfou($u, $p);
			$ff->update($_POST["content"]);
		}
		
		echo json_encode($result);
	}
} else if (isset($_GET["digg"])) {
	$result = $action->diggDiggItem();
	echo json_encode($result);
}
?>