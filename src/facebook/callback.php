<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('MyFacebook.php');

$fb = new MyFacebook();

$_SESSION['fb_access_token'] = $fb->get_access_token();
$caption = $_SESSION['caption'];
$photos_arr = $_SESSION['photos_arr'];
$url = '/me/photos';

echo '<pre>$_SESSION</br>';
var_dump($_SESSION);
echo '</pre>';

$fb->fb_publish_photos($caption, $photos_arr, $_SESSION['fb_access_token'], $url);

// $photos_obj = new MyPhotos();
// $photos_obj->delete_photos($photos_arr);
?>