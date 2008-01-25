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
	
	public function getRecentLoginUser($size = 10) {
		$sql = 'SELECT id AS id, gmt_last_login AS gmtLastLogin, avator_url AS avator, username AS username FROM digg_user WHERE id > 0 ORDER BY gmt_last_login DESC, id ASC LIMIT 0, ' . $size;
		
		$resultArray = $this->dao ? $this->dao->execute($sql) : NULL;
		
		return $resultArray;
	}
}
?>