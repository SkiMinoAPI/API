<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
 * Original: AiMuC
*/
include '../lib/func.php';

require('system/init.php');
$id = $_GET['id'];
if ($id != null) {
    $Url = GetVideoSrc($id);
    if (!empty($Url)) {
        echo json_code($Url, 200);
    } else {
        echo json_code('', 404, 'No found');
    }
} else {
    echo json_code('', 500, 'No set id');
}
?>