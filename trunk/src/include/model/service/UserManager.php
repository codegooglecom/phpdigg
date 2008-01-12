<?php
include_once "config/Config.php";

include_once "model/dao/UserDao.php";
include_once "model/service/BaseManager.php";

class UserManager extends BaseManager {
	public function __construct() {
		$this->dao = new UserDao(Config::getDateSourceName(), Config::$db_user, Config::$db_password);
	}
	
	public function findByName($name) {
		return $this->dao ? $this->dao->findByName($name) : NULL;
	}
}
?>