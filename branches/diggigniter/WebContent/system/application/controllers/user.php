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

		$id = get_cookie('userId');
		
		if ($id) {
			$data['user'] = $this->user->getUser($id);
			$data['title'] = $data['user']['username'];
		}
		
		$recentLoginUser = $this->user->getRecentLoginUser();
		$data['recent'] = $recentLoginUser;
		
		$this->load->layout('layouts/user', 'user/index', $data);
	}

	public function show() {
		$username = $this->uri->segment(3);
		
		if ($username) {
			$user = $this->user->findByName($username);
			$data['user'] = $user;
			
			$profile = $this->user->getUserProfile($user['id']);
			$data['profile'] = $profile;
			
			$data['title'] = $user['username'];
			$this->load->layout('layouts/user', 'user/show', $data);
		} else {
			redirect('digg');
		}
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

	public function logout() {
		delete_cookie('userId', '.diggigniter.com', '/');
		delete_cookie('userName', '.diggigniter.com', '/');
		
		redirect('digg');
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

	public function profile() {
		$id = get_cookie('userId');
		
		if ($id) {
			$data['user'] = $this->user->getUser($id);
			$data['userProfile'] = $this->user->getUserProfile($id);
			$data['accountBinding'] = $this->user->getAccountBinding($id);
	
			$data['title'] = '设置';
			$this->load->layout('layouts/user', 'user/profile', $data);	
		} else {
			$url = 'user/profile';
			redirect('user/login/' . $url);
		}
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
		$method = $this->uri->segment(3);

		$id = get_cookie('userId');
		$username = get_cookie('userName');
		switch($method) {
			case 'password':
				$password = $_POST['original-pwd'];
				$new_pwd = $_POST['new-pwd'];
				
				
				if ($this->user->auth($username, $password)) {
					$this->user->update($id, array('password' => md5($new_pwd)));
				} else {
					show_error('password wrong');
				}
				$data['title'] = '用户';
				$data['message'] = '修改密码成功';
				$this->load->layout('layouts/user', 'user/index', $data);
				break;			case 'profile':
				$profile = array(
					'user_id' => $id,
					'gender' => $_POST['gender'],
					'birth_year' => $_POST['birth-year'],
					'birth_month' => $_POST['birth-month'],
					'birth_day' => $_POST['birth-day'],		
					'province' => $_POST['province'],
					'city' => $_POST['city'],		
					'home_province' => $_POST['home-province'],
					'home_city' => $_POST['home-city'], 		
					'homepage' => $_POST['homepage'],
					'comment' => $_POST['comment']
				);
				$this->user->updateProfile($id, $profile);
				
				$data['title'] = '用户';
				$data['message'] = '更新个人资料成功';
				$this->load->layout('layouts/user', 'user/index', $data);
				break;
			case 'bind':
				$data = array (
					'user_id' => $id,
					'type' => $_POST['type'],
					'username' => $_POST['username'],
					'password' => base64_encode($_POST['password'])
				);
				
				$result = $this->user->bind($id, $data);
				
				$data['title'] = '用户';
				$data['message'] = '绑定成功';
				break;
		}
	}

	public function remove() {

	}
}

?>