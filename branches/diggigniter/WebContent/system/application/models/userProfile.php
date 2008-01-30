<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserProfile extends Model {
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
	
	public function getUser($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('digg_user');
		
		return $query->row_array();
	}
	
	public function getUserProfile($id) {
		$this->db->where('user_id', $id);
		$query = $this->db->get('digg_user_profile');
		
		$profile = $query->row_array();
		
		if ($profile == NULL) {
			$profile = array (
				'id' => NULL,
				'user_id' => $id,
				'gender' => 0,
				'birth_year' => 1985,
				'birth_month' => 1,
				'birth_day' => 1,		
				'province' => 0,
				'city' => '',		
				'home_province' => 0,
				'home_city' => '', 		
				'homepage' => '',
				'comment' => ''
			);
		}
		
		return $profile;
	}
	
	public function getAccountBinding($id) {
		return array(
			'ff' => array(
				'username' => 'test',
				'password' => ''
			)
		);
	}
	
	public function insert() {
		$gmt = date('Y-m-d H:i:s');
		$user = array(
			'username' => $_POST['username'],
			'password' => md5($_POST['password']),
			'email' => $_POST['email'],
			'gmt_create' => $gmt,
			'gmt_last_login' => $gmt
		);
		
		$result = $this->db->insert('digg_user', $user);
		
		if ($result) {
			$user['id'] = $this->db->insert_id();
			
			return $user;
		}
		return $result;
	}
	
	public function auth($username, $password) {
		$password = md5($password);
		
		$this->db->select('id')->from('digg_user')->where('username', $username)->where('password', $password);
		$query = $this->db->get();
		$row = $query->row_array();
		
		if ($row) {
			return $row['id'];
		} else {
			return NULL;
		}
	}
	
	public function updateGmtLastLogin($id) {
		$gmt = date('Y-m-d H:i:s');
		$data = array(
			'gmt_last_login' => $gmt
		);
		$this->db->where('id', $id)->update('digg_user', $data);
	}
}

?>