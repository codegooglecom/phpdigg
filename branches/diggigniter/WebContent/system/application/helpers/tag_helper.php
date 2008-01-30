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

/*
function img($img, $attributes = array()) {
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
*/

function img($uri, $attributes = array()) {
	$CI = &get_instance();
	$uri = $CI->config->item('base_url') . 'system/public/' . $uri;
	$uri = '<img src="' . $uri . '"';
	
	if (is_array($attributes) AND count($attributes) > 0)
	{
		foreach ($attributes as $key => $val)
		{
			$uri .= ' ' . $key . '="' . $val . '"';
		}
	}

	$uri .= '></img>';
	return $uri;
}

?>