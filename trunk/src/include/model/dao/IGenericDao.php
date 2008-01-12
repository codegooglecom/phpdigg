<?php
interface IGenericDao {

	/**
	 * Find an object from the database
	 * @param $id: string, integer
	 * @return object
	 */
	public function findById($id);

	/**
	 * Save the object to the database
	 * @param $obj: object
	 * @return boolean
	 */
	public function save($obj);
	
	/**
	 *
	 */
	public function update($obj);	

	/**
	 * Remove the object from the database
	 * @param $obj: object
	 * @return boolean
	 */
	public function remove($obj);
	
	/**
	 * Remove a object by its id
	 *
	 * @param string $id
	 */
	public function removeById($id);

	/**
	 * Find all object of a certain class
	 * @return array of object
	 */
	public function findAll($config = null);
	
	/**
	 * Query from some criteria
	 *
	 * @param array $criteria
	 * 
	 * @return object or NULL if not found
	 */
	public function query($criteria);
	
	/**
	 * Simplely execute a sql
	 *
	 * @param String $sql
	 */
	public function execute($sql);
}
?>