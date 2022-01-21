<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$host = $_GET['host'];
$port = $_GET['port'];
$name = $_GET['sn'];
$theme = $_GET['theme'];
$fon = $_GET['font'];
$font = str_replace(':enand:', '&', $fon);

require_once 'ApiQuery.php';
require_once 'ApiPing.php';

require_once 'closeTags.php';

if (isset($_GET['image'])) {
    header("Content-type: image/JPEG");
    if (isset($theme)) {
        if ($theme == 'light') {
            $im = imagecreatefromjpeg('./theme/light.jpg');
            $color = ImageColorAllocate($im, 255,255,153);
        } elseif ($theme == 'dark') {
            $im = imagecreatefromjpeg('./theme/dark.jpg');
            $color = ImageColorAllocate($im, 127,255,170);
        } else {
            $im = imagecreatefromjpeg('./theme/defult.jpg');
            $color = ImageColorAllocate($im, 0,204,255);
        }
    } else {
        $im = imagecreatefromjpeg('./theme/defult.jpg');
        $color = ImageColorAllocate($im, 0,204,255);
    }
    
    //定义字体
    if ($font == null) {
        $font = 'defult.ttf';
    }
    
    //定义颜色&字体
    $black = ImageColorAllocate($im, 0,0,0);
    $pink = ImageColorAllocate($im, 255,119,201);
    
    //Ping
    require_once 'ApiQuery.php';
    require_once 'ApiPing.php';
    
    //读取Info
    require_once 'closeTags.php';
    
    $players = $InfoPing['players']['online'].'/'.$InfoPing['players']['max'];
    $version = explode(" ", $InfoPing['version']['name'], 2);
    
    //判定是否在线
    if ($InfoPing !== false) {
    
        /*
        在线
        输出
        */
        $Ping = $Timer * 1000;
        imagettftext($im, 20, 0, 12, 40, $color, $font, $name);
        imagettftext($im, 20, 0, 12, 72, $color, $font, ' Host:'.$host);
        imagettftext($im, 20, 0, 12, 104, $color, $font,' Port:'.$port);
        imagettftext($im, 20, 0, 12, 147, $color, $font,' Players:'.$players);
        imagettftext($im, 20, 0, 12, 185, $pink, $font,' Version:'.$version[1]);
        imagettftext($im, 20, 0, 12, 210, $pink, $font, ' Ping:'.$Ping.'ms');
        imagettftext($im, 20, 0, 12, 250, $pink, $font, ' Powered By SkiMino');
        ImageGif($im);
        ImageDestroy($im);
        } else {
        
        /*
        离线&不存在
        输出
        */
        imagettftext($im, 20, 0, 12, 40, $color, $font, $name);
        imagettftext($im, 20, 0, 12, 72, $color, $font, ' Host:'.$host);
        imagettftext($im, 20, 0, 12, 104, $color, $font,' Port:'.$port);
        imagettftext($im, 20, 0, 12, 210, $pink, $font,' Offline/Not such Host');
        imagettftext($im, 20, 0, 12, 250, $pink, $font, ' Powered By SkiMino');
        ImageGif($im);
        ImageDestroy($im);
        }
} else {
    if (($Info = $Query->GetInfo()) !== false) {

        if ($Info['GameName'] == 'MINECRAFT') {
            $platform = 'Minecraft: Java Edition';
        } else if ($Info['GameName'] == 'MINECRAFTPE') {
            $platform = 'Minecraft: Bedrock Edition';
        } else {
            $platform = $Info['GameName'];
        }
    
        $playerList = array();
        if (!empty($Query->GetPlayers())) {
            $playerList = $Query->GetPlayers();
        }
    
        $pluginList = array();
        if (!empty($Info['Plugins'])) {
            $pluginList = $Info['Plugins'];
        }
    
        $json = array(
            'status' => 'Yes',
            'platform' => $platform,
            'gametype' => $Info['GameType'],
            'icon' => $Info['favicon'],
            'motd' => array(
                'ingame' => $Info['HostName']
            ),
            'host' => array(
                'host' => $host,
                'hostip' => $Info['HostIp'],
                'port' => $Info['HostPort']
            ),
            'players' => array(
                'max' => $Info['MaxPlayers'],
                'online' => $Info['Players'],
                'list' => $playerList
            ),
            'version' => array(
                'version' => $Info['Version'],
                'software' => $Info['Software']
            ),
            'Plugins' => $pluginList,
            'queryinfo' => array(
                'agreement' => 'Query',
                'processed' => $Timer
            )
        );
    } else if ($InfoPing !== false) {
        $json = array(
            'icon' => $InfoPing['favicon'],
            'motd' => $InfoPing['description'],
            'server' => array(
                'host' => $host,
                'port' => $port
            ),
            'players' => array(
                'max' => $InfoPing['players']['max'],
                'online' => $InfoPing['players']['online']
            ),
            'version' => array(
                'version' => $version[1],
                'protocol' => $InfoPing['version']['protocol']
            ),
            'queryinfo' => array(
                'Ping' => $Timer * 1000 .'ms'
            )
        );
    } else {
        $json = array(
            'status' => 'No',
            'host' => $host,
            'port' => $port
        );
    }
    echo json_code($json, 200);
}
?>
