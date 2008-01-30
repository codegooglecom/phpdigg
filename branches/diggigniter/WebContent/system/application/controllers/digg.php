<?php

class Digg extends Controller {
	public function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('tag');
		$this->load->helper('cookie');
//		$this->load->scaffolding('digg_item');
		$this->load->model('diggItem', 'item');	
		$this->load->model('userProfile', 'user');	
	}
	
	public function index() {
		$data['title'] = '分享你的秘密';		
		$data['query'] = $this->item->select();
		
		$id = get_cookie('userId');
		if ($id) {
			$data['user'] = $this->user->getUser($id);
		}
		
		$recentLoginUser = $this->user->getRecentLoginUser();
		$data['recent'] = $recentLoginUser;
//		$this->load->view('digg/index', $data);
		$this->load->layout('layouts/digg', 'digg/index', $data);
	}
	
	public function show() {

	}
	
	public function add() {
		$data['title'] = '添加';
		$this->load->view('digg/add', $data);
	}
	
	public function edit() {
		
	}
	
	public function create() {
		$result = $this->item->insert();

		redirect('digg');
	}
	
	public function update() {
		
	}
	
	public function remove() {
		
	}
}

?>