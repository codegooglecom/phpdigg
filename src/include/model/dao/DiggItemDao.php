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
			"userIp",
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
			"user_id",
			"user_ip", 
			"user_name", 
			"gmt_create"
			));
	}

	public function digg($id) {
		$pdo = $this->dataSource->getPdo();

		$tableName = $this->mapping->getTableName();
		
		$sql = "UPDATE " . $tableName . " SET digg_item_recommend = digg_item_recommend + 1 WHERE digg_item_id =:id;";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(
			"id" => $id
		));

		$sql = "SELECT digg_item_recommend FROM " . $tableName . " WHERE digg_item_id =:id;";
		$statement = $pdo->prepare($sql);
		$statement->execute(array(
			"id" => $id
		));

		$resultArray = $statement->fetch(PDO::FETCH_NUM);
		return $resultArray[0];
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
	
	public function getUserAvator($userId) {
		$sql = "SELECT b.avator_url as avator FROM digg_item a, digg_user b WHERE a.user_id = b.id and b.id = :id";
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($sql);
		$statement->execute(array(
			"id" => $userId
		));
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		
		return $result["avator"];
	}
}

?>