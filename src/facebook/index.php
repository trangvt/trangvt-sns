<?php
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('Login.php');

$permissions = ['email', 'publish_actions'];

$login = new Login();
$login->login($permissions);
