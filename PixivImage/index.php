<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$pid = $_GET['pid'];
if ($pid != null) {
    $d = curl('https://www.pixiv.net/ajax/illust/' . $pid . '/pages');
    $e = str_replace('"error":false,', '', $d);
    echo $e;
    
} else {
    json_code('', 500, 'No set pid');
}
?>