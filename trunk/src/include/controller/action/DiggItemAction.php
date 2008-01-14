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
		$diggItem->setContent($content);
		$diggItem->setGmtCreate(date("Y-m-d"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);

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

			setcookie($id, "digg", mktime().time() + 60 * 60 * 12);
		} else {
			$result = array(
				"id" => $id,
				"count" => $count,
				"digg" => false
			);
		}
		
		return $result;
	}
	
	public function indexDiggItem($page = 1, $size = 5) {
		$resultArray = $this->manager->findAll(array(
			"orderby" => "recommend",
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