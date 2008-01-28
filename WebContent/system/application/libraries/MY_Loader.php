<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
	var $CI;
	
	public function __construct() {
		parent::CI_Loader();
		
		$this->CI = &get_instance();
	}
	
	public function css($uri) {
		$uri = $this->CI->config->item('base_url') . 'system/public/' . $uri;
		
		echo '<link rel="stylesheet" type="text/css" href="' . $uri . '" />';
	}
	
	public function js() {
		$uri = $this->$CI->config->item('base_url') . 'system/public/' . $uri;
		
		echo '<script type="text/javascript" src="' . $uri . '"></script>';
	}
	
	public function layout($layout, $essential, $data) {
		$data['essential'] = $essential;
		$this->view($layout, $data);		
	}
}

?>