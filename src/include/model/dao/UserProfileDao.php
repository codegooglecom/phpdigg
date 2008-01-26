<?php
include_once "config/Config.php";

include_once "model/dao/GenericDao.php";
include_once "model/bean/UserProfile.php";

class UserProfileDao extends GenericDao {
	public function __construct($dsn, $username, $password) {
		parent::__construct($dsn, $username, $password);
			
		$this->mapping = new Mapping("UserProfile", "digg_user_profile", "id",
		array(
			'id',
			'userId',
			'gender',
			'birthYear',
			'birthMonth',
			'birthDay',		
			'province',
			'city',		
			'homeProvince',
			'homeCity',		
			'homepage',
			'comment'
			),
			array(
			'id',
			'user_id',
			'gender',
			'birth_year',
			'birth_month',
			'birth_day',		
			'province',
			'city',		
			'home_province',
			'home_city',		
			'homepage',
			'comment'
			));
	}

	public function findByUserId($userId) {
		$mappingInfo = $this->mapping->getMappingInfo();
		$columnName = $mappingInfo["userId"];
		$tableName = $this->mapping->getTableName();
			
		$query = "SELECT * FROM " . $tableName . " WHERE " . $columnName . "=:userId;";

		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute(array("userId" => $userId));
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		$userProfile = null;

		if ($result) {
			$userProfile = $this->makeObject($result);
		}
			
		return $userProfile;
	}
}
?>