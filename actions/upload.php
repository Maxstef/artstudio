<?php

if($_FILES['file']['size'] > 0){
    $path_parts = pathinfo($_FILES['file']['name']);
    $_FILES['file']['name'] = md5($filename . time()) . '.' . $path_parts['extension'];
    $filename = $_FILES['file']['name'];
    $uploaddir = '../uploaded/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    echo $filename;
} else {
    echo '';
}

move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
