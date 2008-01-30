<?php

class User extends Controller {
	public function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('tag');
		$this->load->helper('cookie');

		$this->load->model('userProfile', 'user');
	}

	public function index() {
		$data['title'] = '分享你的秘密';

		$this->load->layout('layouts/user', 'user/index', $data);
	}

	public function show() {

	}

	# GET /user/login
	public function login() {
		$id = get_cookie('userId');
		if ($id) {
			redirect('digg');
		} else {
			$data['title'] = '登录';		
			$this->load->layout('layouts/user', 'user/login', $data);
		}
	}

	public function auth() {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (strlen($username) == 0 || strlen($password) == 0) {
			show_error('用户名或密码不能为空');
		} else {
			$id = $this->user->auth($username, $password);

			if ($id) {
				# Authentication passed, setup cookies
				$this->user->updateGmtLastLogin($id);

				$cookie = array(
                   'name'   => 'userId',
                   'value'  => $id,
                   'expire' => 60 * 60 * 24,
                   'domain' => '.diggigniter.com',
                   'path'   => '/'
				);
				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'userName',
                   'value'  => $username,
                   'expire' => 60 * 60 * 24,
                   'domain' => '.diggigniter.com',
                   'path'   => '/'
				);
				set_cookie($cookie);

				redirect('digg');
			} else {
				show_error('用户名或密码错误');
			}
		}
	}

	public function register() {
		$data['title'] = '注册';
		$this->load->layout('layouts/user', 'user/register', $data);
	}

	public function setting() {		
		$id = get_cookie('userId');
		
		$data['user'] = $this->user->getUser($id);
		$data['userProfile'] = $this->user->getUserProfile($id);
		$data['accountBinding'] = $this->user->getAccountBinding($id);
		
		$data['title'] = '设置';
		$this->load->layout('layouts/user', 'user/setting', $data);
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