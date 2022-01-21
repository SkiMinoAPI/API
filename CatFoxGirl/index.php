<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$data = json_decode(file_get_contents('https://assets.datas.gq/counts.json'));
$url = 'https://drive.datas.gq/drive1/CatFoxGirl/'.rand(0, $data->CatFoxGirl->count).'.jpg';
header("Content-type: image/jpeg");
$im = imagecreatefromjpeg($url);
imagepng($im);
imagedestroy($im);
?>
