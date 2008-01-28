<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class DiggItem extends Model {
	
	var $id;
	var $title = '';
	var $content = '';
	
	var $user_id = '0';
	var $user_name = 'anonymous';
	var $user_ip = '0.0.0.0';
	
	var $gmt_create = '0000-00-00 00:00:00';
	
	public function select($offset = 0, $pageSize = 10) {
		$this->db
			->select('digg_item.*, digg_user.avator_url')
			->from('digg_item')
			->join('digg_user', 'digg_user.id = digg_item.user_id')
			->orderby('digg_item.gmt_create', 'desc')
			->limit($pageSize, $offset);

		$query = $this->db->get();
		
		return $query;
	}
	
	public function __construct() {
		parent::Model();
	}
	
	public function insert() {
		$this->title = $_POST['title'];
		$this->content = $_POST['content'];
		$this->gmt_create = date('Y-m-d H:i:s');
		
		$this->user_id = $_COOKIE['userId'] || '0';
		$this->user_name = $_COOKIE['userName'] ? $_COOKIE['userName'] : 'anonymous';
		$this->user_ip = $_SERVER["REMOTE_ADDR"];
		
		
		$result = $this->db->insert('digg_item', $this);
		return $result;
	}
	
	public function update() {
		
	}
	
	public function delete() {
		
	}
}

?>