<?php
include_once "config/Config.php";

include_once "model/dao/GenericDao.php";
include_once "model/bean/AccountBinding.php";

class AccountBindingDao extends GenericDao {
	public function __construct($dsn, $username, $password) {
		parent::__construct($dsn, $username, $password);
			
		$this->mapping = new Mapping("AccountBinding", "digg_account_binding", "id",
		array(
			'id',
			'userId',
			'type',
			'username',
			'password'
		),
		array(
			'id',
			'user_id',
			'type',
			'account_username',
			'account_password'
		));
	}

	public function findByUserId($userId, $type = 'ff') {
		$mappingInfo = $this->mapping->getMappingInfo();
		$columnName = $mappingInfo["userId"];
		$tableName = $this->mapping->getTableName();
			
		$query = "SELECT * FROM " . $tableName . " WHERE " . $columnName . "=:userId AND type=:type;";

		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute(array(
			"userId" => $userId,
			"type" => $type
		));
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		$account = NULL;

		if($result) {
			$account = $this->makeObject($result);
		}
			
		return $account;
	}
}
?>