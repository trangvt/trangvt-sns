<?php
session_start();

require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('MyTwitter.php');

$twitter = new MyTwitter();
$response = $twitter->get_oauth_token();

$oauth_token = $response['oauth_token'];
$oauth_token_secret = $response['oauth_token_secret'];

$photos_arr = $_SESSION['photos_arr'];

setcookie('oauth_token', $oauth_token, time() + (86400 * 30), "/");
setcookie('oauth_token_secret', $oauth_token_secret, time() + (86400 * 30), "/");

$twitter->twitter_login($oauth_token);
