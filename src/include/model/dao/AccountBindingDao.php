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

	public function findByUserId($userId, $type = NULL) {
		$mappingInfo = $this->mapping->getMappingInfo();
		$columnName = $mappingInfo["userId"];
		$tableName = $this->mapping->getTableName();
			
		$query = "SELECT * FROM " . $tableName . " WHERE " . $columnName . "=:userId";

		if ($type != NULL) {
			$query .= ' AND type=:type';
		}
		
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);

		if ($type == NULL) {
			$statement->execute(array(
				"userId" => $userId
			));	
			
			$resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);

			$accountArray = array(
				'tt' => array(
					'id' => NULL,
					'username' => '',
					'password' => ''
				),
				'ff' => array(
					'id' => NULL,
					'username' => '',
					'password' => ''
				),
				'jw' => array(
					'id' => NULL,
					'username' => '',
					'password' => ''
				)
			);
	
			if ($resultArray) {
				foreach($resultArray as $account) {
					$accountArray[$account['type']]['id'] = $account['id'];
					$accountArray[$account['type']]['username'] = $account['account_username'];
					$accountArray[$account['type']]['password'] = $account['account_password'];
				}
			}
				
			return $accountArray;
		} else {
			$statement->execute(array(
				"userId" => $userId,
				'type' => $type
			));	
			
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			
			if ($result) {
				$account = $this->makeObject($result);
				
				return $account;
			}
			
			return NULL;
		}
	}
}
?>