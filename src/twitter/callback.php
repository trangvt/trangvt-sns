<?php
require_once(dirname(dirname(__FILE__)).'/config.php');

$oauth_token = $_COOKIE['oauth_token'];
$oauth_token_secret = $_COOKIE['oauth_token_secret'];
$caption = $_COOKIE['caption'];
$photos_arr = json_decode($_COOKIE['photos_arr'], true);

$oauth_verifier = $_GET["oauth_verifier"];
$tmhOAuth = new tmhOAuth(array(
    'consumer_key' => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_KEY_SECRET,
    'user_token' => $oauth_token,
    'user_secret' => $oauth_token_secret, 
    'curl_ssl_verifypeer' => false
));

$tmhOAuth->request(
    'POST',
    $tmhOAuth->url('oauth/access_token', ''),
    [
        'oauth_verifier' => $oauth_verifier
    ]
);

var_dump($tmhOAuth->response['response']);

die();
$response = $tmhOAuth->extract_params($tmhOAuth->response["response"]);
$tmhOAuth->config["user_token"] = $response['oauth_token']; 
$tmhOAuth->config["user_secret"] = $response['oauth_token_secret'];

$code = $tmhOAuth->request(
    'POST', 
    'https://upload.twitter.com/1.1/media/upload.json',
    [
        'media_data' => base64_encode(file_get_contents($img)),
        'status' => $txt 
    ],
    true, // use auth
    true // multipart
);

$upload_json = json_decode($tmhOAuth->response['response']);

if ($code == 200){
    echo 'upload successfully';
    
    $code = $tmhOAuth->user_request(array(
        'method' => 'POST',
        'url'    => $tmhOAuth->url('1.1/statuses/update'),
        'params' => array(
          'media_ids' => $upload_json->media_id,
          'status'    => 'Picture time',
        )
    ));
    
} else {
}
