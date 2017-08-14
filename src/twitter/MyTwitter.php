<?php
// /opt/lampp/htdocs/trangvt-sns/src/config.php
require_once(dirname(dirname(__FILE__)).'/config.php');

class MyTwitter extends tmhOAuth {
    /**
     * Init object
     */
    public function __construct($oauth_token = NULL, $oauth_token_secret = NULL) {
        $this->tmhOAuth = new tmhOAuth(array(
            'consumer_key' => CONSUMER_KEY,
            'consumer_secret' => CONSUMER_KEY_SECRET,
            'user_token' => $oauth_token,
            'user_secret' => $oauth_token_secret,
            'curl_ssl_verifypeer' => false
        ));
    }

    /**
     * Get oauth token
     * @return [array] [description]
     */
    public function get_oauth_token() {
        $to = $this->tmhOAuth;

        $to->request(
            'POST',
            $to->url('oauth/request_token', '')
        );
        $response = $to->extract_params($to->response["response"]);

        return $response;
    }

    public function twitter_login($oauth_token) {
        $to = $this->tmhOAuth;

        $url = $to->url("oauth/authorize", "") . '?oauth_token=' . $oauth_token;
        header("Location:".$url);
        exit();
    }

    public function generate_oauth_token($oauth_verifier) {
        $to = $this->tmhOAuth;

        $to->request(
            'POST',
            $to->url('oauth/access_token', ''),
            [
                'oauth_verifier' => $oauth_verifier
            ]
        );

        $response_oauth = $to->extract_params($to->response["response"]);

        return $response_oauth;
    }

    public function upload_photos($response_oauth, $photos_arr) {
        $to = $this->tmhOAuth;

        $to->config["user_token"] = $response_oauth['oauth_token']; 
        $to->config["user_secret"] = $response_oauth['oauth_token_secret'];

        $url = 'https://upload.twitter.com/1.1/media/upload.json';

        $media_ids_arr = [];
        foreach ($photos_arr as $key => $photo) {
            $to->request(
                'POST',
                $url,
                [
                    'media_data' => base64_encode(file_get_contents($photo)),
                ],
                true, // use auth
                true // multipart
            );
            $upload_json = json_decode($to->response['response']);

            $media_ids_arr[] = $upload_json->media_id;
        }

        return $media_ids_arr;
    }

    public function post_status($media_ids_arr, $caption) {
        $to = $this->tmhOAuth;

        $to->user_request(array(
            'method' => 'POST',
            'url'    => $to->url('1.1/statuses/update'),
            'params' => array(
              'media_ids' => $media_ids_arr,
              'status'    => $caption,
            )
        ));

        return TRUE;
    }
}