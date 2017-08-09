<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('MyFacebook.php');

$fb = new MyFacebook();

$_SESSION['fb_access_token'] = $fb->get_access_token();
$url = '/me/photos';

echo '<pre>$_SESSION</br>';
var_dump($_SESSION);
echo '</pre>';

$fb->fb_publish_photos($_SESSION['caption'], $_SESSION['photos_arr'], $_SESSION['fb_access_token'], $url);

?>