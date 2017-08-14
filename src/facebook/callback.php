<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('MyFacebook.php');

$fb = new MyFacebook();

$_SESSION['fb_access_token'] = $fb->get_access_token();

$fb_access_token = $_SESSION['fb_access_token'];
$caption = $_SESSION['caption'];
$photos_arr = $_SESSION['photos_arr'];
$url = '/me/photos';

$respone = $fb->fb_publish_photos($caption, $photos_arr, $fb_access_token, $url);

if ($respone)
	echo 'Success';
?>