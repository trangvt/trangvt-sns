<?php
require_once('config.php');

if(!isset($_FILES)) {
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
$caption = $_REQUEST['caption'];
?>
<div>
    <div>
        <h4>Facebook</h4>
        <a href="facebook/index.php">Facebook</a>
    </div>
    <div>
        <h4>Twitter</h4>
        <a href="twitter/index.php">Facebook</a>
    </div>
    <div>
        <h4>Instagram</h4>
        <a href="instagram/index.php">Facebook</a>
    </div>
    </br>
</div>