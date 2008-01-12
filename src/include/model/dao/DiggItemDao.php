<?php

include_once "config/Config.php";

include_once "model/dao/GenericDao.php";
include_once "model/bean/DiggItem.php";

class DiggItemDao extends GenericDao {
	public function __construct($dsn, $username, $password) {
		parent::__construct($dsn, $username, $password);
			
		$this->mapping = new Mapping("DiggItem", "digg_item", "id",
		array(
			"id", 
			"img", 
			"url", 
			"recommend", 
			"notRecommend", 
			"name", 
			"content", 
			"userId", 
			"userName", 
			"gmtCreate"
		),
		array(
			"digg_item_id", 
			"digg_item_img", 
			"digg_item_url", 
			"digg_item_recommend", 
			"digg_item_not_recommend", 
			"digg_item_name", 
			"digg_item_content", 
			"userId", 
			"userName", 
			"gmtCreate"
		));
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