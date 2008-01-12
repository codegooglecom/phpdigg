<?php

include_once "model/bean/DiggItem.php";
include_once "model/dao/DiggItemDao.php";
include_once "model/service/DiggItemManager.php";

include_once "controller/action/Action.php";

class DiggItemAction extends Action {
	public function __construct() {
		$this->manager = new DiggItemManager();
	}
}

?>