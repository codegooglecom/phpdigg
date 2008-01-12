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
	
	public function indexDiggItem() {
		$resultArray = $this->manager->findAll(array(
			"orderby" => "recommend"
		));
		$result = array();
		foreach($resultArray as $diggItem) {
			$result[] = $diggItem->toJSONObject();
		}
		return $result;
	}
}

?>