<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$tmp = $_GET['url'];
$url = str_replace(':enand:', '&', $tmp);
$j = array(
    "shorturl" => $tmp,
    "realurl" => LocaUrl($url)
);
echo json_code($j, 200);
?>