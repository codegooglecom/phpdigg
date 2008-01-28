<?php

class User extends Controller {
	public function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('tag');
		
		$this->load->model('userProfile', 'user');
	}
	
	public function index() {
		$data['title'] = '分享你的秘密';
		
		$this->load->layout('layouts/user', 'user/index', $data);
	}
	
	public function show() {

	}
	
	public function login() {
		$data['title'] = '登录';
		$this->load->layout('layouts/user', 'user/login', $data);
	}
	
	public function register() {
		$data['title'] = '注册';
		$this->load->layout('layouts/user', 'user/register', $data);
	}
	
	public function setting() {
		$data['title'] = '设置';
		$this->load->layout('layouts/user', 'user/edit', $data);
	}
	
	public function edit() {
		
	}
	
	public function create() {
		$result = $this->user->insert();
		
		if ($result) {
			redirect('digg');
		} else {
			redirect('user/register');
		}
		echo $this->db->insert_id();
	}
	
	public function update() {
		
	}
	
	public function remove() {
		
	}
}

?>