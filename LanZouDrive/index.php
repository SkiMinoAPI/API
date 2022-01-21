<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

function getSubstr($str, $leftStr, $rightStr) {
    $left = strpos($str, $leftStr);
    $right = strpos($str, $rightStr,$left);
    if($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}

if (isset($_GET['url'])) {
    $lanzou = curl(str_replace("com/","com/tp/",$_GET['url']),'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1');
    $domianload = getSubstr($lanzou,"domianload = '","';");
    $downloads = getSubstr($lanzou,"downloads = '","';");
    $url = $domianload.$downloads;
    preg_match_all("/<div class=\"md\">(.*?)<span class=\"mtt\">/", $lanzou, $name);
    preg_match_all('/发布者:<\\/span>(.*?)<span class=\\"mt2\\">/', $lanzou, $author);
    preg_match_all('/<div class=\\"md\\">(.*?)<span class=\\"mtt\\">\\((.*?)\\)<\\/span><\\/div>/', $lanzou, $size);
    $json = array(
        "name" => $name[1][0], 
        "author" => $author[1][0],  
        "size" => $size[2][0],
        "url" => $url 
    );
    echo json_code($json, 200);
} else {
    echo json_code('', 500, 'No set url');
}
?>