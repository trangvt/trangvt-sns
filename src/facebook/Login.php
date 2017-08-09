<?php
// /opt/lampp/htdocs/trangvt-sns/src/config.php
require_once(dirname(dirname(__FILE__)).'/config.php');

use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;

class Login {
    public function __construct() {
        $this->fb = new Facebook\Facebook([
            'app_id' => APP_ID_ENV_NAME,
            'app_secret' => APP_SECRET_ENV_NAME,
            'default_graph_version' => DEFAULT_GRAPH_VERSION
        ]);
    }

    public function login($permissions = []) {
        $current_path = $_SERVER['REQUEST_URI'];
        $callback = 'callback.php';
        
        $helper = $this->fb->getRedirectLoginHelper();
        $url = ROOT_URL.$current_path.$callback;
        $url = $helper->getLoginUrl($url, $permissions);
        
        header("Location:".$url);
        exit();
    }

    public function get_access_token() {
        $helper = $this->fb->getRedirectLoginHelper();
        $_SESSION['FBRLH_state'] = $_GET['state'];

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }

            return $accessToken->getValue();
        }

        return $accessToken->getValue();
    }
}