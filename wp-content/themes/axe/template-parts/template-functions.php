<?php

// функции на избранные
require 'template-favorites.php';

// Return url to post img
function get_post_img()
{
	//default img from template: /img/img-zat.png
	$img = get_the_post_thumbnail_url();
	if($img === false)
		$img = get_template_directory_uri() . '/img/img-zat.png';
	return $img;
}

function la_ajax_result($result, $info = null, $type = null)
{
	$result = array('result' => $result);
	if(isset($info)) $result['info'] = $info;
	if(isset($type)) $result['type'] = $type;

	echo json_encode($result);

	die;
}

?>