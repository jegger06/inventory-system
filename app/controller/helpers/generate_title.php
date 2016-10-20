<?php 

function title($title = '') {
	if(is_null($title) || empty($title)) {
		$title = explode(".", basename($_SERVER['PHP_SELF']));
		$title = ucwords(str_replace('_', ' ', $title[0]));
	}
	return ucwords(strtolower($title));
}
