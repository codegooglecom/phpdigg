<?php

abstract class Action {
	abstract public function execute();
	
	protected $manager;
	protected function setManager($manager) {
		$this->manager = $manager;
	}
}

?>