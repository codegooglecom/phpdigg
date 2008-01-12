<?php

//require_once "lib/Snoopy.class.php";

class Fanfou {
	private $username;
	private $password;
	
	private $proxy;
	
	private $proxyOptions = array (
		"agent" => "Fanfou php-lib",
		"version" => "0.1",
		"client" => "",
		"client-url" => "http://code.google.com/p/libfanfou"
	);
	
	private $responseType = array(
		"json" => "json",
		"xml" => "xml",
		"rss" => "rss"
	);
	private $apiHost = "http://api.fanfou.com";
	
	private $statusesModule = "statuses";
		private $userTimelineMethod = "user_timeline";
		private $friendsTimelineMethod = "friends_timeline";
		private $publicTimelineMethod = "public_timeline";
		private $updateMethod = "update";
	
	private $usersModule = "users";
		private $friendsMethod = "friends";
		private $followersMethod = "followers";
	
	private $friendshipsModule = "friendships";
	private $privateMessageModule = "private_message";
	
	public function __construct($username = null, $password = null) {
		$this->username = $username;
		$this->password = $password;
		
		$this->initProxy();
	}
	
	private function initProxy() {
	    if (is_object($this->proxy) && is_a($this->proxy, "Snoopy")) {
            return;
        }

        $this->proxy = new Snoopy();
        
        $this->proxy->agent = $this->proxyOptions["agent"];
        $this->proxy->rawheaders = array(
            "X-Twitter-Client"         => $this->proxyOptions["client"],
            "X-Twitter-Client-Version" => $this->proxyOptions["version"],
            "X-Twitter-Client-URL"     => $this->proxyOptions["client-url"]
        );

        if ($this->username && $this->password) {
        	$this->proxy->user = $this->username;
        	$this->proxy->pass = $this->password;
        }
	}
	
	private function isResponseOk() {
		return strpos($this->proxy->response_code, "200");
	}
	
	private function fetch($uri) {
		$this->proxy->fetch($uri);
		$results = null;
		
		if ($this->isResponseOk()) {
			$results = $this->proxy->results;
		}

		return $results;
	}
	
	private function submit($uri, $data = null) {
		$this->proxy->submit($uri, $data);
		$results = null;
		
		if ($this->isResponseOk()) {
			$results = $this->proxy->results;
		}
		
		return $results;
	}
	
	public function timeline($category) {
		$uri = $this->apiHost . "/" . $this->statusesModule . "/" . $category . ".json";
		$results = $this->fetch($uri);
		
		return json_decode($results);
	}
	
	public function userTimeline() {
		return $this->timeline($this->userTimelineMethod);
	}
	
	public function friendsTimeline() {		
		return $this->timeline($this->friendsTimelineMethod);
	}
	
	public function publicTimeline() {
		return $this->timeline($this->publicTimelineMethod);
	}	
	
	public function update($text) {
		$uri = $this->apiHost . "/" . $this->statusesModule . "/" . $this->updateMethod . ".json";
		
		$results = $this->submit(
            $uri,
            array(
                "status" => $text,
                "source" => "libfanfou"
            )
        );
        
        return json_decode($results);
	}
	
	public function friends() {
		$uri = $this->apiHost . "/" . $this->usersModule . "/" . $this->friendsMethod . ".json";
		
		$results = $this->fetch($uri);
		
		return json_decode($results);
	}
	
	public function followers() {
		$uri = $this->apiHost . "/" . $this->usersModule . "/" . $this->followersMethod . ".json";
		
		$results = $this->fetch($uri);
		
		return json_decode($results);
	}
	
}

?>