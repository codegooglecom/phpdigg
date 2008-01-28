<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function css() {
	$len = func_num_args();
	if ($len == 0) {
		return '';
	} else {
		$CI = &get_instance();
		$uri = func_get_args();
		
		$link = '';
		foreach ($uri as $val)
		{
			$val = $CI->config->item('base_url') . 'system/public/' . $val;
			$link .= '<link rel="stylesheet" type="text/css" href="' . $val . '" />';
		}

		return $link;
	}
}

function js() {
	$len = func_num_args();
	if ($len == 0) {
		return '';
	} else {
		$CI = &get_instance();
		$uri = func_get_args();
		
		$link = '';
		foreach ($uri as $val)
		{
			$val = $CI->config->item('base_url') . 'system/public/' . $val;
			$link .= '<script type="text/javascript" src="' . $val . '"></script>';
		}

		return $link;
	}
}

function img() {
	$len = func_num_args();
	if ($len == 0) {
		return '';
	} else {
		$CI = &get_instance();
		$uri = func_get_args();
		
		$link = '';
		foreach ($uri as $val)
		{
			$val = $CI->config->item('base_url') . 'system/public/' . $val;
			$link .= '<img src="' . $val . '"></img>';
		}

		return $link;
	}
}

?>