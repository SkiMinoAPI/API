<?php
/**
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$host = $_GET['host'];
$port = $_GET['port'];
$font = str_replace(':enand:', '&', $fon);

require_once 'ApiQuery.php';
require_once 'ApiPing.php';

require_once 'closeTags.php';

if ($host != null) {
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
            'status' => 'Online',
            'platform' => $platform,
            'gametype' => $Info['GameType'],
            'icon' => str_replace("\n", "", $Info['favicon']),
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
            'status' => 'Offline',
            'host' => $host,
            'port' => $port
        );
    }
    echo json_code($json, 200);
} else {
    echo json_code('', 500, 'No set host');
}
?>
