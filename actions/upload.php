<?php
    
require '../config/config.php';
require '../shared/function.php';

if($_FILES['file']['size'] > 0 && is_loged_in()){
    $path_parts = pathinfo($_FILES['file']['name']);
    $_FILES['file']['name'] = md5($filename . time()) . '.' . $path_parts['extension'];
    $filename = $_FILES['file']['name'];
    $uploaddir = '../uploaded/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
        $im =    imagecreatefromjpeg($uploadfile);       
        $my_size = 1000;
        $w_src = imagesx($im);
        $h_src = imagesy($im);
                  
        if ($w_src>$h_src && $w_src > $my_size) {
           $w = $my_size;
           $h = $my_size * ($h_src/$w_src);
        } else if ($w_src<$h_src && $h_src > $my_size) {
           $h = $my_size;
           $w = $my_size * ($w_src/$h_src);
        } else {
            $w = $w_src;
            $h = $h_src;
        }
        $dest = imagecreatetruecolor($w,$h);    
        imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $h_src); 
        imagejpeg($dest, substr($uploadfile, 0, -4).".jpg");
    }
    echo $filename;
} else {
    echo '';
}


