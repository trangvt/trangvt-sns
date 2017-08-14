<?php
require_once('config.php');

$photos_obj = new MyPhotos();
$photos_obj->delete_all_photos();

echo 'Success';