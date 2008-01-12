<?php

include_once "controller/action/Action.php";
include_once "model/service/UserManager.php";
include_once "model/service/CorporationManager.php";

include_once "model/service/soap/TokenValidateService.php";

class RouteAction extends Action {
	private $userManager;
	private $corporationManager;

	private $tokenValidateService;

	public function __construct() {
		$this->userManager = new UserManager();
		$this->corporationManager = new CorporationManager();

		$this->tokenValidateService = new TokenValidateService();
	}

	public function execute() {
		$result = 0x0;

		$cookie = $this->buildCookie();
		if ($cookie["aepUserId"] && $cookie["aepInstanceId"]) {
			return $cookie;
		}

		$appId = NULL;

		$aepUserId = NULL;
		$aepInstanceId = NULL;
		$token = NULL;

		if (isset($_REQUEST["app_id"])) {
			$appId = $_REQUEST["app_id"];
			
			$cookie["appId"] = $appId;
		}

		if (isset($_REQUEST["user_id"])) {
			$aepUserId = $_REQUEST["user_id"];
		}

		if (isset($_REQUEST["app_instance_id"])) {
			$aepInstanceId = $_REQUEST["app_instance_id"];
		}

		if (isset($_REQUEST["token"])) {
			$token = $_REQUEST["token"];
		}

		if ($appId && $aepUserId && $aepInstanceId && $token) {
			$userType = $this->tokenValidateService->validateUser($aepUserId, $appId, $aepInstanceId, $token);

			$cookie["userType"] = $userType;

			if ($userType == -1 || $userType == -2) {
				//Not a legal AEP user
				//echo "Inlegal user"
				$result |= 0x0;
			} else {
				//Legal AEP user for the ISV
				$result |= 0x1;
				$result |= ($userType == 1 ? 0x10 : 0x00);

				$cookie["isLegal"] = true;
				$cookie["isSubscriber"] = ($userType == 1);

				$cookie["aepUserId"] = $aepUserId;
				$cookie["aepInstanceId"] = $aepInstanceId;

				$userArray = $this->userManager->query(array ("aepUserId" => $aepUserId));
				$user = $userArray[0];
				
				if ($user) {
					//The user has register in the ISV
					$result |= 0x010000;
					$result |= ($userType == 1) ? 0x000100 : 0x000000;

					$cookie["canModifyUser"] = true;
					$cookie["mustSetupUser"] = !(
						$user->getName() &&
						$user->getSex() &&
						$user->getFaxNumber()
					);
					
					
					$cookie["canModifyCorporation"] = ($userType == 1);

					$cookie["userId"] = $user->getId();
					$cookie["corporationId"] = $user->getCorporationId();
					
					$cookie["userName"] = $user->getName();
				} else {
					//The user has NOT register in the ISV
					$corpArray = $this->corporationManager->query(array ("aepInstanceId" => $aepInstanceId));
					$corp = $corpArray[0];
					
					if ($corp) {
						$cookie["corporationId"] = $corp->getId();
					}

					if ($userType == 1) {
						//The user is a subscripter
						/*if ($corp) {
							//echo "Please setup your information.";
							} else {
							//echo "Please setup your corporation.";
							}*/

						$result |= ($corp ? 0x110100 : 0x111100);

						$cookie["canModifyCorporation"] = true;
						$cookie["mustSetupCorporation"] = $corp ? false : true;
						$cookie["canModifyUser"] = $cookie["mustSetupUser"] = true;
					} else {
						//Else if not
						/*if ($corp) {
							//echo "Please setup your information.";
							} else {
							//echo "Please inform your administrator.";
							}*/
						$result |= ($corp ? 0x110000 : 0x000000);
						$cookie["canModifyUser"] = $corp ? true : false;
						$cookie["mustSetupUser"] = true;
					}
				}
			}
			
			$this->setupCookie($cookie);
		} else {
			//echo "Inlegal user"
			$result |= 0x0;
		}
		return $cookie;
	}

	private function setupCookie($cookie) {
		foreach ($cookie as $key => $value) {
			setcookie($key, $value);
		}
	}

	private function buildCookie() {
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
			"appId" => NULL,
			"userName" => NULL
		);

		if (isset($_COOKIE["aepUserId"])) {
			foreach ($cookie as $key => $value) {
				$cookie[$key] = $_COOKIE[$key];
			}
		}

		return $cookie;
	}
}
?>