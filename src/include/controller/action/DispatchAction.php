<?php

include_once "controller/action/Action.php";

class DispatchAction extends Action {
	public function execute() {
		$method = $_REQUEST["method"];
		
		if ($method) {
			$this->dispatch($method);
		} else {
			echo "default";
		}
	}
	
	private function dispatch($method) {
		if ($method != "dispach")
			$this->$method();
	}
}

?>