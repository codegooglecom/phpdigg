<?php
include_once "include/Prepare.php";

include_once "controller/action/DiggItemAction.php";
include_once "model/service/AccountBindingManager.php";

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
		} else {
			$accountBindingManager = new AccountBindingManager();
			$userId = $_COOKIE['userId'];
			$accountBinding = $accountBindingManager->findByUserId($userId);
			if ($accountBinding['tt']['id'] || $accountBinding['ff']['id'] || $accountBinding['jw']['id']) {
				include_once "lib/Snoopy.class.php";
				include_once "lib/TwitterBase.class.php";
				include_once "lib/Twitter.class.php";
				include_once "lib/Fanfou.class.php";
				include_once "lib/Jiwai.class.php";
				
				foreach ($accountBinding as $type => $account) {
					if ($account['id'] == NULL) {
						continue;	
					}
					
					$client = NULL;
					$u = $account['username'];
					$p = $account['password'];
					$p = base64_decode($p);
					
					switch($type) {
						case 'tt':
							$client = new Twitter($u, $p);
							break;
						case 'ff':
							$client = new Fanfou($u, $p);
							break;
						case 'jw':
							$client = new Jiwai($u, $p);
							break;
					}
					if ($client != NULL) {
						$client->update($_POST["content"]);	
					}
				}
			}
		}		
		
		echo json_encode($result);
	}
} else if (isset($_GET["digg"])) {
	$result = $action->diggDiggItem();
	echo json_encode($result);
}
?>