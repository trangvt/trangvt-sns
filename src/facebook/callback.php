<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('Login.php');

$oauth = new Login();
$_SESSION['fb_access_token'] = $oauth->get_access_token();

$fb = new Facebook\Facebook([
            'app_id' => APP_ID_ENV_NAME,
            'app_secret' => APP_SECRET_ENV_NAME,
            'default_graph_version' => DEFAULT_GRAPH_VERSION
        ]);

foreach ($_SESSION['photos_arr'] as $key => $value) {
    $fb_photos = [
        'message' => $_SESSION['caption'],
        'source' => $fb->fileToUpload($value)
    ];

    try {
        $response = $fb->post(
            '/me/photos',
            $fb_photos,
            $_SESSION['fb_access_token']
        );
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}

?>