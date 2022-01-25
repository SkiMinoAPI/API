<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$url = $_GET['url'];
if ($url != null) {
    $a = json_decode(getSubstr(curl($url), 'window.pageInfo = window.videoInfo = ', ';'));
    $b = json_decode($a->currentVideoInfo->ksPlayJson);
    $c = json_decode($a->currentVideoInfo->ksPlayJson, true);
    /*$su = count($c['adaptationSet'][0]['representation']);
    for ($i=$su; $i==-1; $i-1) {
        $urls[] = array(
            $c['adaptationSet'][0]['representation'][$i]['qualityType'] => $c['adaptationSet'][0]['representation'][$i]['url']
        );
    }
    print_r($urls);*/
    $json = array(
        "videoid" => $b->videoId,
        "author" => array(
            "name" => $a->user->name,
            "id" => $a->user->id
        ),
        "videourl" => /*$urls*/$c['adaptationSet'][0]['representation'][0]['url']
    );
    echo json_code($json, 200);
} else {
    echo json_code('', 500, 'No set url');
}