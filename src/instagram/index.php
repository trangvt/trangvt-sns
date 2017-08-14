<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');

$caption = $_SESSION['caption'];
$photos_arr = $_SESSION['photos_arr'];

foreach ($photos_arr as $key => $photo) {
	try {
		$insta = new InstagramUpload();
		$insta->Login(INSTA_USER, INSTA_PASS);
		$insta->UploadPhoto($photo, $caption);
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}