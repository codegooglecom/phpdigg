<?php

include_once "model/bean/User.php";
include_once "model/dao/UserDao.php";
include_once "model/dao/UserProfileDao.php";
include_once "model/service/UserManager.php";
include_once "model/service/UserProfileManager.php";
include_once "model/service/AccountBindingManager.php";

include_once "controller/action/Action.php";

class UserAction extends Action {

	public function __construct() {
		$this->manager = new UserManager();
		$this->profileManager = new UserProfileManager();
		$this->accountBindingManager = new AccountBindingManager();
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
			setcookie("userId", $user->getId(), time() + 60 * 60 * 48);
			setcookie("userName", $user->getUsername(), time() + 60 * 60 * 48);

			$this->manager->update(array (
				"id" => $user->getId(),
				"gmtLastLogin" => date("Y-m-d H:i:s")
			));

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
		$user->setGmtLastLogin(date("Y-m-d H:i:s"));

		$result = $this->manager->save($user);

		if ($result) {
			$result = array ("success" => true, "id" => $user->getId());

			setcookie("userId", $user->getId(), time() + 60 * 60 * 48);
			setcookie("userName", $user->getUsername(), time() + 60 * 60 * 48);
		} else {
			$result = NULL;
		}

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

		$uploadFileInfo = pathinfo($_FILES["avator"]["name"]);

		$uploadFileName = time(). "." . $uploadFileInfo["extension"]; //basename($_FILES['avator']['name']);

		$uploadFile = $uploadDir . $uploadFileName;

		move_uploaded_file($_FILES['avator']['tmp_name'], $uploadFile);

		$userId = $_COOKIE["userId"];

		$this->manager->update(array(
			"id" => $userId,
			"avatorUrl" => $uploadFile
		));

		return $uploadFile;
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

	public function getRecentLoginUser($size = 10) {
		$userList = $this->manager->getRecentLoginUser($size);

		return $userList;
	}

	public function changePassword() {
		$result = array(
			'success' => false
		);

		$userId = $_COOKIE['userId'];

		if ($userId == null || $userId == '0') {
			$result['success'] = false;

			return $result;
		}

		$original = $_POST['original-pwd'];
		$encrypt = md5($original);

		$new = $_POST['new-pwd'];

		$user = $this->manager->findById($userId);

		if ($user != null && $user->getPassword() == $encrypt) {
			$encrypt = md5($new);

			$result['success'] = $this->manager->update(array(
				'id' => $userId,
				'password' => $encrypt
			));
		}

		return $result;
	}

	public function updateProfile() {
		$userId = $_COOKIE['userId'];

		$userProfile = $this->profileManager->findByUserId($userId);

		if ($userProfile == NULL) {
			$userProfile = new UserProfile();
			$userProfile->setUserId($userId);
		}

		$userProfile->setGender($_POST['gender']);
		$userProfile->setBirthYear($_POST['birth-year']);
		$userProfile->setBirthMonth($_POST['birth-month']);
		$userProfile->setBirthDay($_POST['birth-day']);

		$userProfile->setProvince($_POST['province']);
		$userProfile->setCity($_POST['city']);

		$userProfile->setHomeProvince($_POST['home-province']);
		$userProfile->setHomeCity($_POST['home-city']);

		$userProfile->setHomepage($_POST['homepage']);
		$userProfile->setComment($_POST['comment']);

		if ($userProfile->getId() == null) {
			$this->profileManager->save($userProfile);
		} else {
			// SHOULD UPDATE THE GenericDao::update, HERE IS A TRICK
			$this->profileManager->update($userProfile->toJSONObject());
		}

		return $userProfile;

	}

	public function getUserProfile() {
		$userId = $_COOKIE['userId'];

		$userProfile = $this->profileManager->findByUserId($userId);

		if ($userProfile == NULL) {
			$userProfile = new UserProfile();
			$userProfile->setUserId($userId);
		}

		return $userProfile;
	}

	public function bindAccount() {
		$userId = $_COOKIE['userId'];
		$type = $_POST['type'];
		
		$accountBinding = $this->accountBindingManager->findByUserId($userId, $type);

		if ($accountBinding == NULL) {
			$accountBinding = new AccountBinding();
			$accountBinding->setUserId($userId);
		}

		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = base64_encode($password);

		$accountBinding->setType($type);
		$accountBinding->setUsername($username);
		$accountBinding->setPassword($password);

		if ($accountBinding->getId() == null) {
			$this->accountBindingManager->save($accountBinding);
		} else {
			// SHOULD UPDATE THE GenericDao::update, HERE IS A TRICK
			$this->accountBindingManager->update($accountBinding->toJSONObject());
		}

		return $accountBinding;
	}

	public function getAccountBinding($type = 'ff') {
		$userId = $_COOKIE['userId'];
		$accountBinding = $this->accountBindingManager->findByUserId($userId, NULL);

		if ($accountBinding == NULL) {
			$accountBinding = new AccountBinding();
			$accountBinding->setUserId($userId);
		}
		
		return $accountBinding;
	}
}
?>