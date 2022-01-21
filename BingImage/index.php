<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
 preg_match('/<url>([^<]+)<\/url>/isU', $str, $matches);
    $imgurl = 'http://cn.bing.com'.$matches[1];
header("Location: {$imgurl}");
?>