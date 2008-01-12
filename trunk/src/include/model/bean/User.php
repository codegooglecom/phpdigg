<?php

class User {
	private $id;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	private $name;
	private $sex;
	private $faxNumber;
	private $groupId;
	private $corporationId;
	private $aepInstanceId;
	private $aepUserId;
	private $comments;
	private $creator;
	private $gmtCreate;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getSex() {
		return $this->sex;
	}

	public function setSex($sex) {
		$this->sex = $sex;
	}

	public function getFaxNumber() {
		return $this->faxNumber;
	}

	public function setFaxNumber($faxNumber) {
		$this->faxNumber = $faxNumber;
	}

	public function getGroupId() {
		return $this->groupId;
	}

	public function setGroupId($groupId) {
		$this->groupId = $groupId;
	}

	public function getCorporationId() {
		return $this->corporationId;
	}

	public function setCorporationId($corporationId) {
		$this->corporationId = $corporationId;
	}

	public function getAepInstanceId() {
		return $this->aepInstanceId;
	}

	public function setAepInstanceId($aepInstanceId) {
		$this->aepInstanceId = $aepInstanceId;
	}

	public function getAepUserId() {
		return $this->aepUserId;
	}

	public function setAepUserId($aepUserId) {
		$this->aepUserId = $aepUserId;
	}

	public function getComments() {
		return $this->comments;
	}

	public function setComments($comments) {
		$this->comments = $comments;
	}

	public function getCreator() {
		return $this->creator;
	}

	public function setCreator($creator) {
		$this->creator = $creator;
	}

	public function getGmtCreate() {
		return $this->gmtCreate;
	}

	public function setGmtCreate($gmtCreate) {
		$this->gmtCreate = $gmtCreate;
	}

	public function toJSON() {
		$temp = array (
			"id" => $this->id,
			"name" => $this->name,
			"sex" => $this->sex,
			"faxNumber" => $this->faxNumber,
			"groupId" => $this->groupId,
			"corporationId" => $this->corporationId,
			"aepInstanceId" => $this->aepInstanceId,
			"aepUserId" => $this->aepUserId,
			"comments" => $this->comments,
			"creator" => $this->creator,
			"gmtCreate" => $this->gmtCreate
		);
		
		return $temp;
	}
}

?>