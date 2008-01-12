<?php
include_once "config/Config.php";

include_once "model/dao/GenericDao.php";
include_once "model/bean/User.php";

class UserDao extends GenericDao {
	public function __construct($dsn, $username, $password) {
		parent::__construct($dsn, $username, $password);
			
		$this->mapping = new Mapping("User", "DEMO_USER", "id",
		array("id", "name", "sex", "faxNumber", "groupId", "corporationId", "aepInstanceId", "aepUserId", "comments", "creator", "gmtCreate"),
		array("USER_ID", "USER_NAME", "SEX", "FAX_NUMBER", "GROUP_ID", "CORPORATION_ID", "AEP_INSTANCEID", "AEP_USERID", "COMMENTS", "CREATOR", "GMT_CREATE"));
	}

	public function findByName($name) {
		$mappingInfo = $this->mapping->getMappingInfo();
		$columnName = $mappingInfo["name"];
		$tableName = $this->mapping->getTableName();
			
		$query = "SELECT * FROM " . $tableName . " WHERE " . $columnName . "=:name;";
			
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute(array("name" => $name));
		$result = $statement->fetch(PDO::FETCH_NUM);
			
		$user = NULL;
			
		if ($result) {
			$user = new $this->makeObject($result);
		}
			
		return $user;
	}
}
?>