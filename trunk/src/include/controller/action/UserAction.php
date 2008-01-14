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
		if ($user != null && $user->getPassword() == $_POST["password"]) {
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
		
		$user = new User();
		$user->setUsername($_POST["username"]);
		$user->setPassword($_POST["password"]);
		$user->setEmail($_POST["email"]);
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