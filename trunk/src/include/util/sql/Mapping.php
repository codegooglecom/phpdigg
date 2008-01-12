<?php
class Mapping {

	/*
	 * @type string
	 * Class name of the persistent object
	 */
	private $className;

	/*
	 * @type string
	 * The table mapping the className
	 */
	private $tableName;

	private $idName;

	/*
	 * @type array (string => string)
	 */
	private $mappingInfo;

	public function __construct($className, $tableName, $idName, $fieldName = NULL, $columnName = NULL) {
		$this->className = $className;
		$this->tableName = $tableName;
			
		$this->idName = $idName;
			
		$this->mappingInfo = array();
			
		if ($fieldName && $columnName) {
			$len = count($fieldName);
				
			for ($idx = 0; $idx < $len; $idx++) {
				$this->mappingInfo[$fieldName[$idx]] = $columnName[$idx];
			}
		}
	}

	public function getClassName() {
		return $this->className;
	}

	public function setClassName($className) {
		$this->className = $className;
	}

	public function getTableName() {
		return $this->tableName;
	}

	public function setTableName($tableName) {
		$this->tableName = $tableName;
	}

	public function getIdName() {
		return $this->idName;
	}

	public function setIdName($idName) {
		$this->idName = $idName;
	}

	public function getMappingInfo() {
		return $this->mappingInfo;
	}

	public function setMappingInfo($mappingInfo) {
		$this->mappingInfo = $mappingInfo;
	}
}
?>