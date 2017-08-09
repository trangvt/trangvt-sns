<?php
session_start();
require_once(dirname(dirname(__FILE__)).'/config.php');

// Upload Photo
$insta = new InstagramUpload();
$insta->Login(INSTA_USER, INSTA_PASS);

$caption = $_SESSION['caption'];
$photos_arr = $_SESSION['photos_arr'];

foreach ($photos_arr as $key => $photo) {
	try {
		$insta->UploadPhoto($photo, $caption);
		echo $key;
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}