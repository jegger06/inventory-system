<?php 

function title() {
	$title = explode(".", basename($_SERVER['PHP_SELF']));
	$title = ucwords(str_replace('_', ' ', $title[0]));
	return $title;
}
