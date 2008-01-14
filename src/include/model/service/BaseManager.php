<?php

class BaseManager {
	protected $dao;

	protected function setDao($dao) {
		$this->dao = $dao;
	}

	public function findById($id) {
		return $this->dao ? $this->dao->findById($id) : NULL;
	}

	public function findAll($pagination = null) {
		return $this->dao ? $this->dao->findAll($pagination) : NULL;
	}

	public function save($obj) {
		return $this->dao ? $this->dao->save($obj) : false;
	}

	public function update($obj) {
		return $this->dao ? $this->dao->update($obj) : false;
	}

	public function remove($obj) {
		return $this->dao ? $this->dao->remove($obj) : false;
	}

	public function removeById($id) {
		return $this->dao ? $this->dao->removeById($id) : false;
	}

	public function query($criteria) {
		return $this->dao ? $this->dao->query($criteria) : NULL;
	}

	public function execute($sql) {
		return $this->dao ? $this->dao->execute($sql) : NULL;
	}
	
	public function count() {
		return $this->dao ? $this->dao->count() : null;
	}
}

?>