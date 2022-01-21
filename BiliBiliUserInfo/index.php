<?php
/*
 * By SkiMkino
 * GitHub: https://github.com/XMSMApi
 * License: GPLv3
*/
include '../lib/func.php';

$uid = $_GET['uid'];
if ($uid != null) {
	$a = json_decode(curl('https://api.bilibili.com/x/space/acc/info?mid='. $uid));
	$b = json_decode(curl('https://api.bilibili.com/x/relation/stat?vmid='. $uid));
	$c = json_decode(curl('https://api.bilibili.com/x/space/navnum?mid='. $uid));
	$json = array(
		"uid" => $a->data->mid,
		"name" => $a->data->name,
		"cover" => $a->data->face,
		"sex" => $a->data->sex,
		"birthday" => $a->data->birthday,
		"level" => array(
			$a->data->level,
			$a->data->rank
		),
		"topcover" => $a->data->top_photo,
		"introduction" => $a->data->sign,
		"vip" => array(
			"type" => $a->data->vip->type,
			"due_date" => $a->data->vip->due_date,
			"label" => array(
				"text" => $a->data->vip->label->text,
				"label_theme" => $a->data->vip->label->label_theme,
				"text_color" => $a->data->vip->label->text_color,
				"bg_style" => $a->data->vip->label->bg_style,
				"bg_color" => $a->data->vip->label->bg_color,
				"border_color" => $a->data->vip->label->border_color
			),
			"nickname_color" => $a->data->vip->nickname_color,
			"role" => $a->data->vip->role,
			"vipicon" => $a->data->vip->avatar_subscript_url
		),
		"fans" => array(
			"badge" => $a->data->fans_badge,
			"medal" => array(
				"name" => $a->data->fans_medal->medal,
				"show" => $a->data->fans_medal->show,
				"wear" => $a->data->fans_medal->wear
			),
			"follower" => $b->data->follower,
			"following" => $b->data->following,
			"black" => $b->data->black
		),
		"work" => array(
			"quantity" => $c->data->video,
			"submission" => $c->data->bangumi,
			"cinema" => $c->data->cinema,
			"article" => $c->data->article,
			"playlist" => $c->data->playlist,
			"photoalbum" => $c->data->album,
			"audio" => $c->data->audio,
			"pugv" => $c->data->pugv,
			"season_num" => $c->data->season_num
		),
		"official" => array(
			"role" => $a->data->official->role,
			"title" => $a->data->official->title,
			"honourinfo" => array(
				"pendant" => $a->data->pendant->name,
				"nameplate" => $a->data->nameplate->name
			)
		),
		"live" => array(
			"title" => $a->data->live_room->title,
			"url" => $a->data->live_room->url,
			"cover" => $a->data->live_room->cover,
			"online" => $a->data->live_room->online,
			"id" => $a->data->live_room->roomid
		)
	);
	echo json_code($json, 200);
} else {
	echo json_code('', 500, 'No set id');
}