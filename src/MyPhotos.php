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
}