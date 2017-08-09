<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once('Login.php');

$oauth = new Login();
$_SESSION['fb_access_token'] = $oauth->get_access_token();

echo '</pre>';
var_dump($_SESSION);
?>