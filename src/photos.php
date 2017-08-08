<?php
require_once('config.php');

if(empty($_FILES['imgs'])) {
    echo "Choose photos";
    echo '<br>';
    echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
    exit;
}
$uploaded_photos = $_FILES['imgs'];
$request = $_REQUEST;

$photos_obj = new MyPhotos();
$photos = $photos_obj->reArrayFiles($uploaded_photos);
$photos_arr = $photos_obj->save_photos($photos);

echo '<pre>';
var_dump($photos_arr);
