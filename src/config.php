<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once __ROOT__ . '/php-graph-sdk/src/Facebook/autoload.php';
require_once __ROOT__ . '/instagram-photo-video-upload-api/instagram-photo-video-upload-api.class.php';
require_once __ROOT__ . '/tmhOAuth/tmhOAuth.php';

require_once __ROOT__ . '/src/MyPhotos.php';

//facebook
define('APP_ID_ENV_NAME', '138091156790292');
define('APP_SECRET_ENV_NAME', '2cc1b61c57b133a92144f8143043638d');
define('DEFAULT_GRAPH_VERSION', 'v2.10');
//Instagram
define('INSTA_USER', 'itestseo');
define('INSTA_PASS', '27081991');
//Twitter
$setting = [
    'twitter' => [
            'tw_consumer_key' => 'sGLxhoKRzje36QCYHVm7spu6B',
            'tw_consumer_secret' => '9Ivt6pDKr9W9WxqfsvIJA9ADQt910kmazBLSYLHAs2TLB1BzVk',
            'access_token' => '893305114496303104-Al3lUqqAMGLmUqvTh4ixK1wKlYtAQs1',
            'access_token_secret' => 'yhOITmjMsgLkpSe5b5BD3qhEyojWuCSGDaXa7KhpD12Gi'
        ],
];

$root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
define('ROOT_URL', $root_url);
define('PHOTOS_FOLDER', '/src/photos/');

// http://php.net/manual/en/function.exif-imagetype.php
$GLOBALS['image_types'] = [
    1 => 'gif',
    2 => 'jpeg',
    3 => 'png',
    6 => 'bmp',
    7 => 'tiff',
    8 => 'tiff',
];