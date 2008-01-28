<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserProfile extends Model {
	
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
}

?>