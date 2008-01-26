<?php

class UserProfile {
	public static $GENDER = array (
		'',
		'男',#'\u7537',
		'女',#'\u5973'
	);
	public static $PROVINCE = array (
		'',
		'北京',
		'上海',
		'天津',
		'重庆',
		'河北',
		'山西',
		'内蒙古',
		'辽宁',
		'吉林',
		'江苏',
		'浙江',
		'安徽',
		'福建',
		'江西',
		'山东',
		'河南',
		'湖北',
		'湖南',
		'海南',
		'广东',
		'广西',
		'四川',
		'贵州',
		'云南',
		'西藏',
		'陕西',
		'甘肃',
		'青海',
		'宁夏',
		'新疆',
		'黑龙江',
		'香港',
		'澳门',
		'台湾',
		'海外'
//		'\u5317\u4eac',
//		'\u4e0a\u6d77',
//		'\u5929\u6d25',
//		'\u91cd\u5e86',
//		'\u6cb3\u5317',
//		'\u5c71\u897f',
//		'\u5185\u8499\u53e4',
//		'\u8fbd\u5b81',
//		'\u5409\u6797',
//		'\u6c5f\u82cf',
//		'\u6d59\u6c5f',
//		'\u5b89\u5fbd',
//		'\u798f\u5efa',
//		'\u6c5f\u897f',
//		'\u5c71\u4e1c',
//		'\u6cb3\u5357',
//		'\u6e56\u5317',
//		'\u6e56\u5357',
//		'\u6d77\u5357',
//		'\u5e7f\u4e1c',
//		'\u5e7f\u897f',
//		'\u56db\u5ddd',
//		'\u8d35\u5dde',
//		'\u4e91\u5357',
//		'\u897f\u85cf',
//		'\u9655\u897f',
//		'\u7518\u8083',
//		'\u9752\u6d77',
//		'\u5b81\u590f',
//		'\u65b0\u7586',
//		'\u9ed1\u9f99\u6c5f',
//		'\u9999\u6e2f',
//		'\u6fb3\u95e8',
//		'\u53f0\u6e7e',
//		'\u6d77\u5916'
	);
	
	private $id;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	private $userId;
	
	public function getUserId() {
		return $this->userId;
	}
	
	public function setUserId($userId) {
		$this->userId = $userId;
	}
	
	private $gender;
	private $birthYear;
	private $birthMonth;
	private $birthDay;

	private $province;
	private $city;

	private $homeProvince;
	private $homeCity;

	private $homepage;
	private $comment;

	public function getGender() {
		return $this->gender;
	}

	public function setGender($gender) {
		$this->gender = $gender;
	}

	public function getBirthYear() {
		return $this->birthYear;
	}

	public function setBirthYear($birthYear) {
		$this->birthYear = $birthYear;
	}

	public function getBirthMonth() {
		return $this->birthMonth;
	}

	public function setBirthMonth($birthMonth) {
		$this->birthMonth = $birthMonth;
	}

	public function getBirthDay() {
		return $this->birthDay;
	}

	public function setBirthDay($birthDay) {
		$this->birthDay = $birthDay;
	}

	public function getProvince() {
		return $this->province;
	}

	public function setProvince($province) {
		$this->province = $province;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity($city) {
		$this->city = $city;
	}

	public function getHomeProvince() {
		return $this->homeProvince;
	}

	public function setHomeProvince($homeProvince) {
		$this->homeProvince = $homeProvince;
	}


	public function getHomeCity() {
		return $this->homeCity;
	}

	public function setHomeCity($homeCity) {
		$this->homeCity = $homeCity;
	}

	public function getHomepage() {
		return $this->homepage;
	}

	public function setHomepage($homepage) {
		$this->homepage = $homepage;
	}

	public function getComment() {
		return $this->comment;
	}

	public function setComment($comment) {
		$this->comment = $comment;
	}
	
	public function toJSONObject() {
		$jsonObject = array(
			'id' => $this->id,
			'userId' => $this->userId,
			'gender' => $this->gender,
			'birthYear' => $this->birthYear,
			'birthMonth' => $this->birthMonth,
			'birthDay' => $this->birthDay,		
			'province' => $this->province,
			'city' => $this->city,		
			'homeProvince' => $this->homeProvince,
			'homeCity' => $this->homeCity, 		
			'homepage' => $this->homepage,
			'comment' => $this->comment
		);
		
		return $jsonObject;
	}
	
}

?>