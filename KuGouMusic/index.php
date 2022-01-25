<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$hash = $_GET['hash'];
if ($hash != '') {
	$d = curl("https://m.kugou.com/app/i/getSongInfo.php?cmd=playInfo&hash={$hash}");
	$e = json_decode($d);
	$json = array(
		"songhash" => $hash,
		"songid" => $e->audio_id,
		"fileName" => $e->fileName,
		"songName" => $e->songName,
		"fileSize" => $e->fileSize,
		"songurl" => array(
			"defult" => $e->url,
			"backup" => $e->backup_url[0]
		)
	);
	echo json_code($json, 200);
} else {
	echo json_code('', 500, 'No set hash');
}
?>