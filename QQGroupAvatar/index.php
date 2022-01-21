<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$qgc = $_GET['qgc'];
if ($qgc != null) {
	$size = $_GET['size'];
	if ($size == null) {
		$size = 640;
	}
	if (isset($_GET['json'])) {
		$json = array(
			"qqgcode" => $qgc,
			"size" => $size,
			"avatar" => "https://p.qlogo.cn/gh/{$qgc}/{$qgc}/{$size}"
		);
		echo json_code($json, 200);
	} else {
	$u = 'https://p.qlogo.cn/gh/' . $qgc . '/' . $qgc . '/' . $size;
	header("Location: {$u}");
	}
} else {
	echo json_code('', 500, 'No set qgc');
}
?>