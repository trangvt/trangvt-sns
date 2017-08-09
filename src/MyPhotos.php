<?php
require_once('config.php');

class MyPhotos {
    public function reArrayFiles($file) {
        $file_ary = [];
        $file_count = count($file['name']);
        $file_key = array_keys($file);
        
        for( $i = 0; $i < $file_count; $i++) {
            foreach($file_key as $val) {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }

        return $file_ary;
    }

    /**
     * Move uploaded photo to folder
     * @param  [array] $photos [description]
     * @return [array]         [description]
     */
    public function save_photos($photos) {
        $photos_arr = [];

        foreach($photos as $photo) {
            $type = exif_imagetype($photo['tmp_name']);
            $name = date('YmdHis',time()).mt_rand(). '.' .$GLOBALS['image_types'][$type];
            $path = __ROOT__.PHOTOS_FOLDER.$name;

            move_uploaded_file($photo['tmp_name'], $path);

            $photos_arr[] = $path;
        }

        return $photos_arr;
    }

    /**
     * Delete photos after publish
     * @param  [array] $photos [description]
     * @return [boolean]         [description]
     */
    public function delete_photos($photos) {
        foreach($photos as $photo) {
            if (file_exists($photo))
                unlink($photo);
        }

        return TRUE;
    }
}
