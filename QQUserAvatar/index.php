<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

function t3get($qqcode, $size) {
	$e = curl("https://ptlogin2.qq.com/getface?appid=1006102&imgtype=3&uin=" . $qqcode);
    $f = str_replace('pt.setHeader(', '', $e);
    $g = str_replace(')', '', $f);
    $json = str_replace('&s=100', "&s={$size}", $g);
	return $json;
}

$qc = $_GET['qc'];
if ($qc != null) {
	$size = $_GET['size'];
	if ($size == null) {
		$size = 640;
	}
	if (isset($_GET['json'])) {
		$json = array(
			"qqcode" => $qc,
			"size" => $size,
			"avatars" => array(
				"t0" => "https://q.qlogo.cn/headimg_dl?img_type=jpg&dst_uin={$qc}&spec={$size}",
				"t1" => "https://q1.qlogo.cn/g?b=qq&nk={$qc}&s={$size}",
				"t2" => "https://q2.qlogo.cn/headimg_dl?dst_uin={$qc}&spec={$size}",
				"t3" => json_decode(t3get($qc, $size))->$qc,
				"t4" => "https://q4.qlogo.cn/g?b=qq&nk={$qc}&s={$size}"
			)
		);
		echo json_code($json, 200);
	} else {
		$t = $_GET['t'];
		if ($t == 0) {
			$u = 'https://q.qlogo.cn/headimg_dl?img_type=jpg&dst_uin=' . $qc . '&spec=' . $size;
		} else if ($t == 1) {
			$u = 'https://q1.qlogo.cn/g?b=qq&nk=' . $qc . '&s=' . $size;
		} else if ($t == 2) {
			$u = 'https://q2.qlogo.cn/headimg_dl?dst_uin=' . $qc . '&spec=' . $size;
		} else if ($t == 3) {
			$u = json_decode(t3get($qc, $size))->$qc;
		} else if ($t == 4) {
			$u = 'https://q4.qlogo.cn/g?b=qq&nk='. $qc .'&s=' . $size;
		} else {
			$u = 'https://q.qlogo.cn/headimg_dl?img_type=jpg&dst_uin=' . $qc . '&spec=' . $size;
		}
		header("Location: {$u}");
	}
} else {
	echo json_code('', 500, 'No set qc');
}
?>