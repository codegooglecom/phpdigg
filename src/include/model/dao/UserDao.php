<?php
include_once "config/Config.php";

include_once "model/dao/GenericDao.php";
include_once "model/bean/User.php";

class UserDao extends GenericDao {
	public function __construct($dsn, $username, $password) {
		parent::__construct($dsn, $username, $password);
			
		$this->mapping = new Mapping("User", "digg_user", "id",
		array("id", "username", "password", "email", "nickname", "avatorUrl", "gmtCreate"),
		array("id", "username", "password", "email", "nickname", "avator_url", "gmt_create"));
	}

	public function findByName($name) {
		$mappingInfo = $this->mapping->getMappingInfo();
		$columnName = $mappingInfo["username"];
		$tableName = $this->mapping->getTableName();
			
		$query = "SELECT * FROM " . $tableName . " WHERE " . $columnName . "=:name;";
		
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute(array("name" => $name));
		$result = $statement->fetch(PDO::FETCH_ASSOC);
			
		$user = null;

		if ($result) {
			$user = $this->makeObject($result);
		}
			
		return $user;
	}
}
?>