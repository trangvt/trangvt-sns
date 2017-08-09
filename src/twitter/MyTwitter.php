<?php
// /opt/lampp/htdocs/trangvt-sns/src/config.php
require_once(dirname(dirname(__FILE__)).'/config.php');

class MyTwitter {
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
}