<?php
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('MyFacebook.php');

$permissions = ['email', 'publish_actions'];

$fb = new MyFacebook();
$fb->login($permissions);
