<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

function str_re($str){
  $str = str_replace(' ', "", $str);
  $str = str_replace("\n", "", $str);
  $str = str_replace("\t", "", $str);
  $str = str_replace("\r", "", $str);
  return $str;
}

if ($_GET['from'] == 'ixiaowai') {
  $str = explode("\n", file_get_contents('https://api.ixiaowai.cn/api/sinetxt.txt'));
  $k = rand(0,count($str));
  $sina_img = str_re($str[$k]);
  $size_arr = array('large', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb180', 'thumbnail', 'square');
  $size = !empty($_GET['size']) ? $_GET['size'] : 'large' ;
  $server = rand(1,4);
  if(!in_array($size, $size_arr)){
    $size = 'large';
  }
  $url = 'https://tva'.$server.'.sinaimg.cn/'.$size.'/'.$sina_img.'.jpg';
  $result = array(
    "code" => "200",
    "imgurl" => $url
  );
  $type = $_GET['return'];
  switch ($type) {   
    case 'json':
      $imageInfo = getimagesize($url);  
      $result['width']="$imageInfo[0]";  
      $result['height']="$imageInfo[1]";  
      header('Content-type:text/json');
      echo json_encode($result);  
    break;
    default:
      header("Location:".$result['imgurl']);
    break;
  }
} else if ($_GET['from'] == 'dmoe') {
  $str = explode("\n", file_get_contents('https://www.dmoe.cc/sinetxt.txt'));
  $k = rand(0,count($str));
  $sina_img = str_re($str[$k]);
  $size_arr = array('large', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb180', 'thumbnail', 'square');
  $size = !empty($_GET['size']) ? $_GET['size'] : 'large' ;
  $server = rand(1,4);
  if(!in_array($size, $size_arr)){
    $size = 'large';
  }
  $url = 'https://tva'.$server.'.sinaimg.cn/'.$size.'/'.$sina_img.'.jpg';
  $result = array(
    "code" => "200",
    "imgurl" => $url
  );
  $type = $_GET['return'];
  switch ($type) {   
    case 'json':
      $imageInfo = getimagesize($url);  
      $result['width']="$imageInfo[0]";  
      $result['height']="$imageInfo[1]";  
      header('Content-type:text/json');
      echo json_encode($result);  
    break;
    default:
      header("Location:".$result['imgurl']);
    break;
  }
} else {
    $data = json_decode(file_get_contents('https://assets.datas.gq/counts.json'));
    $url = 'https://drive.datas.gq/drive1/ACGPic/'.rand(0, $data->ACGPic->count).'.jpg';
    header("Content-type: image/jpeg");
    $im = imagecreatefromjpeg($url);
    imagepng($im);
    imagedestroy($im);
}
?>