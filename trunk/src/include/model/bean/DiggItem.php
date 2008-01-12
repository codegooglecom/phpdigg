<?php

class DiggItem {
	private $id;

	private $img;

	private $url;

	private $recommend;

	private $notRecommend;

	private $name;

	private $content;

	private $userId;

	private $userName;

	private $gmtCreate;

	public function toJSON() {

	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getImg() {
		return $this->img;
	}

	public function setImg($img) {
		$this->img = $img;
	}

	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public function getRecommend() {
		return $this->recommend;
	}

	public function setRecommend($recommend) {
		$this->recommend = $recommend;
	}

	public function getNotRecommend() {
		return $this->notRecommend;
	}

	public function setNotRecommend($notRecommend) {
		$this->notRecommend = $notRecommend;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userID) {
		$this->userId = $userID;
	}

	public function getUserName() {
		return $this->userName;
	}

	public function setUserName($userName) {
		$this->userName = $userName;
	}

	public function getGmtCreate() {
		return $this->gmtCreate;
	}

	public function setGmtCreate($gmtCreate) {
		$this->gmtCreate = $gmtCreate;
	}
}

?>