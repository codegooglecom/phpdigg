<?php
include_once "controller/action/Action.php";

class CookieAction extends Action {
	public function __construct() {
	}

	public function execute() {
		$cookie = $this->buildCookie();
		return $cookie;
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
			"aepInstanceId" => NULL		#AEP instance id
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