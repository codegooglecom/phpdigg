<?php
include_once "config/Config.php";

include_once "model/dao/UserProfileDao.php";
include_once "model/service/BaseManager.php";

class UserProfileManager extends BaseManager {
	public function __construct() {
		$this->dao = new UserProfileDao(Config::getDateSourceName(), Config::$db_user, Config::$db_password);
	}
	
	public function findByUserId($userId)  {
		return $this->dao ? $this->dao->findByUserId($userId) : NULL;
	}
}
?>