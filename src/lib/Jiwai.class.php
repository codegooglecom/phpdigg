<?php
class Jiwai extends TwitterBase {
	public function __construct($username, $password) {
		parent::__construct($username, $password);
		
		$this->apiHost = 'http://api.jiwai.de';
	}
}
?>