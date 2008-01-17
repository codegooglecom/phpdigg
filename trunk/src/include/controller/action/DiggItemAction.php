<?php

include_once "model/bean/DiggItem.php";
include_once "model/dao/DiggItemDao.php";
include_once "model/service/DiggItemManager.php";

include_once "controller/action/Action.php";

class DiggItemAction extends Action {
	public function __construct() {
		$this->manager = new DiggItemManager();
	}

	public function execute() {
		
	}
	
	public function createDiggItem() {
		$content = $_POST["content"];

		$diggItem = new DiggItem();
		
		$userId = $_COOKIE["userId"] ? $_COOKIE["userId"] : "0";
		$userName = $_COOKIE["userName"] ? $_COOKIE["userName"] : "anonymous";
		
		$diggItem->setUserId($userId);
		$diggItem->setUserName($userName);
		
		$diggItem->setContent($content);
		$diggItem->setGmtCreate(date("Y-m-d H:i:s"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);

		$this->manager->save($diggItem);
		
		$result = $diggItem->toJSONObject();
		
		return $result;
	}

	public function createImageDiggItem() {
		$name = $_POST["name"];
		$url = $_POST["url"];
		
		if (strlen($name) == 0 || strlen($url) == 0) {
			return null;
		}
	
		$diggItem = new DiggItem();
		
		$username = $_COOKIE["userName"] ? $_COOKIE["userName"] : "anonymous";
		$diggItem->setUserName($username);
		
		$diggItem->setGmtCreate(date("Y-m-d H:i:s"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);
		
		$diggItem->setName($name);
		$diggItem->setUrl($url);
		
		$content = "$username shared image $name <img src='$url' width='64'></img>.";
		
		$diggItem->setContent($content);
		
		$this->manager->save($diggItem);
		
		$result = $diggItem->toJSONObject();
		
		return $result;
	}
	
	public function createMusicDiggItem() {
		$diggItem = new DiggItem();
		
		$username = $_COOKIE["userName"] ? $_COOKIE["userName"] : "anonymous";
		$diggItem->setUserName($username);
		
		$diggItem->setGmtCreate(date("Y-m-d H:i:s"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);
		
		$name = $_POST["name"];
		$url = $_POST["url"];
		
		$diggItem->setName($name);
		$diggItem->setUrl($url);
		
		$content = "$username shared music <a href='$url'>$name</a>.";
		
		$diggItem->setContent($content);
		
		$this->manager->save($diggItem);
		
		$result = $diggItem->toJSONObject();
		
		return $result;
	}
	
	public function diggDiggItem() {
		$id = $_POST["id"];
		$digg = $_COOKIE[$id];

		$result = null;
		if (!$digg) {
			$count = $this->manager->digg($id);

			$result = array(
				"id" => $id,
				"count" => $count,
				"digg" => true
			);

			setcookie($id, "digg", time() + 60 * 60 * 48);
		} else {
			$result = array(
				"id" => $id,
				"count" => $count,
				"digg" => false
			);
		}
		
		return $result;
	}
	
	public function indexDiggItem($page = 1, $size = 5, $order = 'recommend') {
		$resultArray = $this->manager->findAll(array(
			"orderby" => $order,
			"pagination" => array(
				"start" => ($page - 1) * $size ,
				"size" => $size
			)
		));
		$result = array();
		foreach($resultArray as $diggItem) {
			$result[] = $diggItem->toJSONObject();
		}
		return $result;
	}
	
	public function itemCount() {
		$result = $this->manager->count();
		
		return $result;
	}
}

?>