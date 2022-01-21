<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

include "Core/qrlib.php";
$size = $_GET['size'];
if ($size == null) {
$size = 4;
}
$tmp = $_GET['url'];
if ($tmp != null) {
    $url = str_replace(':enand:', '&', $tmp);
    QRcode::png($url, false, 'L', $size, 0);
} else {
    json_code('', 500, 'No set url');
}
?>