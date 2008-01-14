<?php

include_once "util/sql/DataSource.php";
include_once "util/sql/Mapping.php";
include_once "model/dao/IGenericDao.php";

class GenericDao implements IGenericDao {

	protected $dataSource;
	protected $mapping;

	public function __construct($dsn, $username, $password) {
		$this->dataSource = new DataSource($dsn, $username, $password);
		$this->mapping = NULL;
	}

	public function findById($id) {
		$mappingInfo = $this->mapping->getMappingInfo();

		$tableName =  $this->mapping->getTableName();

		$idFieldName = $this->mapping->getIdName();
		$idColumnName = $mappingInfo[$idFieldName];

		$query = "SELECT * FROM " . $tableName . " WHERE " . $idColumnName . "=:id;";

		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute(array ("id" => $id));
			
		$result = $statement->fetch(PDO::FETCH_ASSOC);
			
		$obj = $this->makeObject($result);
			
		return $obj;
	}

	public function save($obj) {
		$mappingInfo = $this->mapping->getMappingInfo();

		$tableName =  $this->mapping->getTableName();

		$idFieldName = $this->mapping->getIdName();
		$idColumnName = $mappingInfo[$idFieldName];

		$idSetterMethod = "set" . ucfirst($idFieldName);

		$id = $this->getNextId($idColumnName, $tableName);
		$obj->$idSetterMethod($id);
			
		/*$query = "INSERT INTO " . $tableName . " SET ";
			
		$first = true;
		$param = array();
		foreach ($mappingInfo as $key => $value) {
			if (!$first) {
				$query .= ", ";
			} else {
				$first = false;
			}

			$query .= ($value . "=:" . $key);

			$getterMethodName = "get" . ucfirst($key);
			$param[$key] = $obj->$getterMethodName();
		}*/
		
		$query = "INSERT INTO " . $tableName . " (";
		
		$first = true;
		foreach ($mappingInfo as $field => $column) {
			if (!$first) {
				$query .= ", ";
			} else {
				$first = false;
			}
			
			$query .= $column;
		}
		$query .= ") VALUES (";
		
		$first = true;
		$param = array();
		foreach ($mappingInfo as $field => $column) {
			if (!$first) {
				$query .= ", ";
			} else {
				$first = false;
			}

			$query .= (":" . $field);

			$getterMethodName = "get" . ucfirst($field);
			$param[$field] = $obj->$getterMethodName();
		}
		$query .= ");";
		
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$result = $statement->execute($param);

		return $result;
	}

	public function update($obj) {
		$mappingInfo = $this->mapping->getMappingInfo();

		$tableName =  $this->mapping->getTableName();

		$idFieldName = $this->mapping->getIdName();
		$idColumnName = $mappingInfo[$idFieldName];
		$idValue = NULL;
		
		$query = "UPDATE " . $tableName . " SET ";
		
		$argType = gettype($obj);
		
		if ($argType == "array" || $argType == "object") {
			$idValue = $obj[$idFieldName];
			
			$first = true;
			foreach ($obj as $key => $value) {
				if ($key != $idFieldName) {
					if (!$first) {
						$query .= ", ";
					} else {
						$first = false;
					}
				
				
					$query .= ($mappingInfo[$key] . "=:" . $key);
				}
			}
			
			$query .= (" WHERE " . $idColumnName . "=:" . $idFieldName . ";");
		}
		
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$result = $statement->execute($obj);
		
		return $result;
	}
	
	public function remove($obj) {
		$mappingInfo = $this->mapping->getMappingInfo();
		
		$tableName =  $this->mapping->getTableName();
		$idFieldName = $this->mapping->getIdName();
		$idColumnName = $mappingInfo[$idFieldName];

		$idGetterMethodName = "get" . ucfirst($idFieldName);
		$id = $obj->$idGetterMethodName();
			
		$query = "DELETE FROM " . $tableName . " WHERE " . $idColumnName . "=:id;";
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
			
		$result = $statement->execute(array ("id" => $id));
		return $result;
	}
	
	public function removeById($id) {
		$mappingInfo = $this->mapping->getMappingInfo();
		
		$tableName =  $this->mapping->getTableName();
		$idFieldName = $this->mapping->getIdName();
		$idColumnName = $mappingInfo[$idFieldName];
			
		$query = "DELETE FROM " . $tableName . " WHERE " . $idColumnName . "=:id;";
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		
		$result = $statement->execute(array ("id" => $id));
		return $result;
	}

	public function findAll($config = null) {
		$orderby = $config ? $config["orderby"] : null;
		$pagination = $config ? $config["pagination"] : null;
		
		$tableName =  $this->mapping->getTableName();
		$mappingInfo = $this->mapping->getMappingInfo();
		
		$query = "SELECT * FROM " . $tableName;
		
		if ($orderby) {
			$query .= (" ORDER BY " . $mappingInfo[$orderby] . " DESC");
		}
		
		if ($pagination) {
			$query .= (" LIMIT " . $pagination["start"] . ", " . $pagination["size"]);
		}
		$query .= ";";
			
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute();

		$resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
			
		$objArray = array();

		foreach ($resultArray as $result) {
			$objArray[] = $this->makeObject($result);
		}

		return $objArray;
	}

	public function query($criteria) {
		$tableName =  $this->mapping->getTableName();
		$mappingInfo = $this->mapping->getMappingInfo();

		$query = "SELECT * FROM " . $tableName . " WHERE ";

		$first = true;
		foreach ($criteria as $key => $value) {
			if (!$first) {
				$query .= " AND ";
			} else {
				$first = false;
			}
				
			$query .= ($mappingInfo[$key] . "=:" .$key);
		}

		$query .= ";";

		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute($criteria);
			
		$resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
			
		$objArray = array();
		
		foreach ($resultArray as $result) {
			$obj = $this->makeObject($result);
			$objArray[] = $obj;
		}
		
			
		return $objArray;
	}

	public function execute($sql) {			
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($sql);
		$statement->execute();

		$resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultArray;
	}
	
	protected function getNextId($idColumnName, $tableName) {
		$query = "SELECT MAX(" . $idColumnName . ") FROM " . $tableName . ";";
			
		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_NUM);
			
		return $result[0] + 1;
	}

	protected function makeObject($result) {
		$mappingInfo = $this->mapping->getMappingInfo();
		$className = $this->mapping->getClassName();

		$obj = NULL;
		if ($result) {
			$obj = new $className();
				
			foreach ($mappingInfo as $key => $value) {
				$setterMethodName = "set" . ucfirst($key);
				$obj->$setterMethodName($result[$value]);
			}
				
		}
		return $obj;
	}
	
	public function count() {
		$tableName =  $this->mapping->getTableName();
		$query = "SELECT COUNT(*) FROM " . $tableName . ";";

		$pdo = $this->dataSource->getPdo();
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_NUM);
			
		return $result[0];
	}
}
?>