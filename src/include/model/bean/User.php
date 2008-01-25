<?php

class User {
	private $id;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	private $username;
	private $password;
	private $email;
	private $nickname;
	private $gmtCreate = "0000-00-00 00:00:00";
	private $gmtLastLogin = "0000-00-00 00:00:00";
	
	
	private $avatorUrl = "images/user_default_medium.gif";
	
	public function getAvatorUrl() {
		return $this->avatorUrl;
	}
	
	public function setAvatorUrl($avatorUrl) {
		$this->avatorUrl = $avatorUrl;
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
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getNickname() {
		return $this->nickname;
	}
	
	public function setNickname($nickname) {
		$this->nickname = $nickname;
	}
	
	public function getGmtCreate() {
		return $this->gmtCreate;
	}
	
	public function setGmtCreate($gmtCreate) {
		$this->gmtCreate = $gmtCreate;
	}
	
	public function getGmtLastLogin() {
		return $this->gmtLastLogin;
	}
	
	public function setGmtLastLogin($gmtLastLogin) {
		$this->gmtLastLogin = $gmtLastLogin;
	}
	
	public function toJSONObject() {
		$temp = array (
			"id" => $this->id,
			"username" => $this->username,
			"password" => $this->password,
			"nickname" => $this->nickname,
			"email" => $this->email,
			"gmtCreate" => $this->gmtCreate
		);
		
		return $temp;
	}
}

?>