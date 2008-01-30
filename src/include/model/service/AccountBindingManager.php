<?php
include_once "config/Config.php";

include_once "model/dao/AccountBindingDao.php";
include_once "model/service/BaseManager.php";

class AccountBindingManager extends BaseManager {
	public function __construct() {
		$this->dao = new AccountBindingDao(Config::getDateSourceName(), Config::$db_user, Config::$db_password);
	}
	
	public function findByUserId($userId, $type = NULL)  {
		return $this->dao ? $this->dao->findByUserId($userId, $type) : NULL;
	}
}
?>