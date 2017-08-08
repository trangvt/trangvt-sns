<?php
class MyPhotos {
    function reArrayFiles($file) {
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

    function save_photos($photos) {
        $photos_arr = [];

        foreach($photos as $val) {
            $newname = date('YmdHis',time()).mt_rand().'.jpg';
            $new_path = __ROOT__.'/src/photos/'.$newname;
            move_uploaded_file($val['tmp_name'], $new_path);

            $photos_arr[] = $new_path;
        }
        return $photos_arr;
    }
}