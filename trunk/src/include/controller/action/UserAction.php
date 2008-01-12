<?php

include_once "model/bean/User.php";
include_once "model/dao/UserDao.php";
include_once "model/service/UserManager.php";
include_once "model/service/ApplicationManager.php";

include_once "controller/action/Action.php";

class UserAction extends Action {
	private $appManager;

	public function __construct() {
		$this->manager = new UserManager();

		$this->appManager = new ApplicationManager();
	}

	public function execute() {
		if (isset($_REQUEST["userId"])) {
			$this->update();
		} else {
			$this->save();
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
		$user->setAepInstanceId($_REQUEST["aepInstanceId"]);
		$user->setAepUserId($_REQUEST["aepUserId"]);
		$user->setComments($_REQUEST["comments"]);
		$user->setCorporationId($_REQUEST["corporationId"]);
		$user->setCreator($_REQUEST["creator"]);
		$user->setFaxNumber($_REQUEST["faxnumber"]);
		$user->setGmtCreate("2007-11-7");
		$user->setGroupId(1);
		$user->setName($_REQUEST["name"]);
		$user->setSex($_REQUEST["sex"]);

		$this->manager->save($user);

		$result = array ("success" => true, "id" => $user->getId());

		setcookie("userId", $user->getId());
		setcookie("mustSetupUser", false);
		setcookie("userName", $user->getName());

		echo json_encode($result);
	}

	public function listUserInfo() {
		$corporationId = $_REQUEST["corporationId"];

		$userArray = $this->getRemoteUser();
		$result = array();
		$result["rows"] = array();

		echo "/*";
		print_r($userArray);
		echo "*/";

		if ($userArray) {
			foreach ($userArray as $user) {
				$temp = array();
				$temp["id"] = NULL;
				$temp["aepUserId"] = $user["userId"];
				$temp["name"] = $user["userName"];
				$temp["group"] = "Seller";

				$result["rows"][$user["userId"]] = $temp;
			}
		}

		$userArray = $this->manager->query(array ("corporationId" => $corporationId));

		foreach ($userArray as $user) {
			$temp = array();
			$temp["id"] = $user->getId();
			$temp["aepUserId"] = $user->getAepUserId();
			$temp["name"] = $user->getName();
			$temp["group"] = ($user->getGroupId() == 1) ? "Manager" : "Seller";

			$result["rows"][$user->getAepUserId()] = $temp;
		}

		/*
		 * Convert the association array to sequence array
		 */
		$result["rows"] = array_values($result["rows"]);


		$result["result"] = count($result["rows"]);
		echo json_encode($result);
	}

	public function getRemoteUser() {
		$appId = isset($_REQUEST["appId"]) ? $_REQUEST["appId"] : "0";

		$aepInstanceId = isset($_REQUEST["aepInstanceId"]) ? $_REQUEST["aepInstanceId"] : "0";

		$result = $this->appManager->getUsingUser($appId, $aepInstanceId);

		return $result ? $result : NULL;
	}

	public function logout() {
		$this->destroyCookie();
	}

	private function destroyCookie() {
		$cookie = array (
			"isLegal" => false,
			"isSubscriber" => false,
			"canModifyCorporation" => false,
			"mustSetupCorporation" => false,
			"canModifyUser" => false,
			"mustSetupUser" => false,
			
			"userType" => NULL,			#-2, -1, 0, 1
			"userId" => NULL,			#ISV user id
			"aepUserId" => NULL,		#AEP user id
			"corporationId" => NULL,	#ISV corporation id
			"aepInstanceId" => NULL,		#AEP instance id
			"appId" => NULL
		);

		foreach ($cookie as $key => $value) {
			setcookie($key, NULL, 0);
		}
	}

	public function manageGroup() {
		$jsonRecordArray = stripslashes($_REQUEST["recordArray"]);
		$recordArray = json_decode($jsonRecordArray);

		foreach ($recordArray as $record) {
			$temp = array();
			foreach ($record as $key => $value) {
				if ($key == "group") {
					$temp["groupId"] = $value == "Manager" ? 1 : 0;
				} else {
					$temp[$key] = $value;
				}
			}

			if ($temp["id"]) {
				$this->manager->update($temp);
			} else {
				$user = new User();
				$user->setAepUserId($temp["aepUserId"]);
				$user->setName($temp["name"]);
				$user->setGroupId($temp["groupId"]);

				$user->setCorporationId($_REQUEST["corporationId"]);

				$this->manager->save($user);
			}
		}

		echo json_encode($recordArray);
	}
}
?>