<?php
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('Login.php');

$fb = new Facebook\Facebook([
    'app_id' => $setting['facebook']['fb_app_id'],
    'app_secret' => $setting['facebook']['fb_app_secret'],
    'default_graph_version' => $setting['facebook']['fb_api_version']
]);

$helper = $fb->getRedirectLoginHelper();

$current_path = $_SERVER['REQUEST_URI'];
$callback = 'callback.php';

$permissions = ['email', 'publish_actions'];
$url = $helper->getLoginUrl($root.$current_path.$callback, $permissions);

header("Location:".$url);
exit();