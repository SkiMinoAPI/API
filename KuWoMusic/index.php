<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$id = $_GET['id'];
if ($id != '') {
	$su = curl('https://antiserver.kuwo.cn/anti.s?type=convert_url&rid=MUSIC_' . $id . '&format=aac%7Cmp3&response=url');
	$tmp = json_decode($su);
	$json = array(
		"songrid" => $id,
		"songurl" => $su,
		"songPic" => curl("http://artistpicserver.kuwo.cn/pic.web?corp=kuwo&type=rid_pic&pictype=url&content=list&size=500&rid={$id}")
	);
	echo json_code($json, 200);
} else {
    echo json_code('', 500, 'No set id');
    exit;
}
?>