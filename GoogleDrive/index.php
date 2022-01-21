<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

function Getbetween($input, $start, $end) {
    $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
    return $substr;
}

$url = $_GET['url'];
if ($url != null) {
	if (isset($_GET['view'])) {
		$export = 'view';
	} else {
		$export = 'download';
	}
	$id = Getbetween($url, 'https://drive.google.com/file/d/', '/view?usp=sharing');
	$ftmpl = 'https://drive.google.com/uc?id=' . $id . '&export=' . $export;
	$filelink = LocaUrl($ftmpl);
	$json = array(
		"url" => $filelink
	);
	echo json_code($json, 200);
} else {
	echo json_code('', 500, 'No set url');
}
?>