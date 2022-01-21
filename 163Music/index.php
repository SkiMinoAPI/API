<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$id = $_GET['id'];
if ($id != null) {
	$json = array(
		"songid" => $id,
		"songurl" => LocaUrl("http://music.163.com/song/media/outer/url?id={$id}"),
		"songlyric" => json_decode(curl("http://music.163.com/api/song/media?id={$id}"))->lyric
	);
	echo json_code($json, 200);
} else {
    echo json_code('', 500, 'No set id');
}
?>