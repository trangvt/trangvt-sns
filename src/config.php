<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once __ROOT__ . '/php-graph-sdk/src/Facebook/autoload.php';
require_once __ROOT__ . '/instagram-photo-video-upload-api/instagram-photo-video-upload-api.class.php';
require_once __ROOT__ . '/tmhOAuth/tmhOAuth.php';
require_once __ROOT__ . '/src/MyPhotos.php';

$setting = [
    'facebook' => [
            'fb_app_id' => '138091156790292',
            'fb_app_secret' => '2cc1b61c57b133a92144f8143043638d',
            'fb_api_version' => 'v2.10'
        ],
    'twitter' => [
            'tw_consumer_key' => 'sGLxhoKRzje36QCYHVm7spu6B',
            'tw_consumer_secret' => '9Ivt6pDKr9W9WxqfsvIJA9ADQt910kmazBLSYLHAs2TLB1BzVk',
            'access_token' => '893305114496303104-Al3lUqqAMGLmUqvTh4ixK1wKlYtAQs1',
            'access_token_secret' => 'yhOITmjMsgLkpSe5b5BD3qhEyojWuCSGDaXa7KhpD12Gi'
        ],
    'instagram' => [
            'insta_user' => 'itestseo',
            'insta_' => '27081991',
        ],
];

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
