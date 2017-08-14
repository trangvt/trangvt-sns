<?php
session_start();

require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('MyTwitter.php');

$oauth_token = $_COOKIE['oauth_token'];
$oauth_token_secret = $_COOKIE['oauth_token_secret'];
$caption = $_SESSION['caption'];
$photos_arr = $_SESSION['photos_arr'];

$twitter = new MyTwitter($oauth_token, $oauth_token_secret);

$oauth_verifier = $_GET["oauth_verifier"];
$response_oauth = $twitter->generate_oauth_token($oauth_verifier);

$media_ids_arr = $twitter->upload_photos($response_oauth, $photos_arr);
$twitter->post_status($media_ids_arr, $caption);

echo 'Success';