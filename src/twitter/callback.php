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

$response_oauth = $tmhOAuth->extract_params($tmhOAuth->response["response"]);
$tmhOAuth->config["user_token"] = $response_oauth['oauth_token']; 
$tmhOAuth->config["user_secret"] = $response_oauth['oauth_token_secret'];

foreach ($photos_arr as $key => $photo) {
    $response_upload = $tmhOAuth->request(
        'POST',
        'https://upload.twitter.com/1.1/media/upload.json',
        [
            'media_data' => base64_encode(file_get_contents($photo)),
        ],
        true, // use auth
        true // multipart
    );

    $upload_json = json_decode($tmhOAuth->response['response']);

    if ($response_upload == 200){
        echo 'upload successfully';
        
        $tmhOAuth->user_request(array(
            'method' => 'POST',
            'url'    => $tmhOAuth->url('1.1/statuses/update'),
            'params' => array(
              'media_ids' => $upload_json->media_id,
              'status'    => $caption,
            )
        ));
    } else {

    }
}
