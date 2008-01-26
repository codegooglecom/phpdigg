<?php

class AccountBinding {
	private $id;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	private $userId;

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	private $type;
	private $username;
	private $password;

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function toJSONObject() {
		$jsonObject = array(
			'id' => $this->id,
			'userId' => $this->userId,
			'username' => $this->username,
			'password' => $this->password,
		);

		return $jsonObject;
	}
}

?>