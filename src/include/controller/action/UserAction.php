<?php

include_once "model/bean/User.php";
include_once "model/dao/UserDao.php";
include_once "model/service/UserManager.php";

include_once "controller/action/Action.php";

class UserAction extends Action {

	public function __construct() {
		$this->manager = new UserManager();
	}

	public function execute() {
		if (isset($_REQUEST["userId"])) {
			$this->update();
		} else {
			$this->save();
		}
	}
	
	public function login() {
		$user = $this->manager->findByName($_POST["username"]);
		$password = $_POST["password"];
		$encryptPassword = md5($password);
		
		if ($user != null && $user->getPassword() == $encryptPassword) {
			setcookie("userId", $user->getId());
			setcookie("userName", $user->getUsername());
			
			return $user;
		} else {
			return null;
		}
	}

	public function update() {
		$user = array(
			"id" => $_REQUEST["userId"],
			"comments" => $_REQUEST["comments"],
			"creator" => $_REQUEST["creator"],
			"faxNumber" => $_REQUEST["faxnumber"],
			"name" => $_REQUEST["name"],
			"sex" => $_REQUEST["sex"]
		);

		$this->manager->update($user);

		setcookie("mustSetupUser", false);
		setcookie("userName", $user["name"]);

		$result = array ("success" => true, "id" => $user["id"]);
		echo json_encode($result);
	}

	public function save() {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		
		if (strlen($username) == 0 || strlen($password) == 0 || strlen($email) == 0) {
			return null;
		}
	
		$user = new User();
		$user->setUsername($username);
		
		$encryptPassword = md5($password);
		$user->setPassword($encryptPassword);
		
		$user->setEmail($email);
		$user->setGmtCreate(date("Y-m-d H:i:s"));

		$this->manager->save($user);
		
		$result = array ("success" => true, "id" => $user->getId());

		setcookie("userId", $user->getId());
		setcookie("userName", $user->getUsername());

		return $result;
	}

	public function logout() {
		$this->destroyCookie();
	}

	public function getLoginUser() {
		$userid = $_COOKIE["userId"];
		
		if ($userid == null || strlen($userid) == 0) {
			return null;
		} else {
			$user = $this->manager->findById($userid);
			
			return $user;		
		}
	
	}
	
	public function updateAvator() {
		$uploadDir = "upload/";
		
		if (!file_exists($uploadDir)) {
			mkdir($uploadDir);
		}
		
		$uploadDir .= date("Y-m-d") . '/';
		
		if (!file_exists($uploadDir)) {
			mkdir($uploadDir);
		}
		
		$uploadfile = $uploadDir . basename($_FILES['avator']['name']);
		
		move_uploaded_file($_FILES['avator']['tmp_name'], $uploadfile);
		
		$userId = $_COOKIE["userId"];
		
		$this->manager->update(array(
			"id" => $userId,
			"avatorUrl" => $uploadfile
		));
		
		return $uploadfile;		
	}
	
	private function destroyCookie() {
		$cookie = array (			
			"userName" => NULL,			#-2, -1, 0, 1
			"userId" => NULL			#ISV user id
		);

		foreach ($cookie as $key => $value) {
			setcookie($key, NULL, 0);
		}
	}
}
?>