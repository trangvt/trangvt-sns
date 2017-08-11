<?php
// /opt/lampp/htdocs/trangvt-sns/src/config.php
require_once(dirname(dirname(__FILE__)).'/config.php');

use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;

class MyFacebook {
    /**
     * Init object
     */
    public function __construct() {
        $this->fb = new Facebook\Facebook([
            'app_id' => APP_ID_ENV_NAME,
            'app_secret' => APP_SECRET_ENV_NAME,
            'default_graph_version' => DEFAULT_GRAPH_VERSION
        ]);
    }

    /**
     * Authentication
     * @param  array  $permissions [description]
     * @return [type]              [description]
     */
    public function login($permissions) {
        $current_path = $_SERVER['REQUEST_URI'];
        $callback = 'callback.php';
        
        $helper = $this->fb->getRedirectLoginHelper();
        $url = ROOT_URL.$current_path.$callback;
        $url = $helper->getLoginUrl($url, $permissions);
        
        header("Location:".$url);
        exit();
    }

    /**
     * Get access token after authenticate
     * @return [string] [description]
     */
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

    /**
     * Publish photos to an user page
     * @param  [string] $caption      [description]
     * @param  [array] $photos       [description]
     * @param  [string] $access_token [description]
     * @param  [string] $url          [description]
     * @return [boolean]               [description]
     */
    public function fb_publish_photos($caption, $photos, $access_token, $url) {
        foreach ($photos as $photo) {
            $fb_photos = [
                'message' => $caption,
                'source' => $this->fb->fileToUpload($photo)
            ];

            try {
                $response = $this->fb->post(
                    $url,
                    $fb_photos,
                    $access_token
                );
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $graphNode = $response->getGraphNode();
        }

        return TRUE;
    }
}