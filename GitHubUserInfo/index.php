<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$name = $_GET['name'];
if ($name != '') {
    $d = curl('https://api.github.com/users/' . $name);
    $e = json_decode($d);
    $json = array(
        "user" => array(
            "idname" => $e->login,
            "name" => $e->name,
            "id" => $e->id,
            "url" => $e->html_url
        ),
        "avatar" => $e->avatar_url,
        "public_repos" => $e->public_repos,
        "followers" => $e->followers,
        "following" => $e->following,
        "time" => array(
            "created_at" => $e->created_at,
            "updated_at" => $e->updated_at
        )
    );
    echo json_code($json, 200);
} else {
    echo json_code('', 500, 'No set name');
}
?>