<?php
include_once "config/Config.php";

include_once "model/dao/DiggItemDao.php";
include_once "model/service/BaseManager.php";

class DiggItemManager extends BaseManager {
	public function __construct() {
		$this->dao = new DiggItemDao(Config::getDateSourceName(), Config::$db_user, Config::$db_password);
	}
	
	public function digg($id) {
		return $this->dao ? $this->dao->digg($id) : null;
	}
	
	public function findByName($name) {
		return $this->dao ? $this->dao->findByName($name) : NULL;
	}
}
?>