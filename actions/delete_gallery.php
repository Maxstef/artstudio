<?php

    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_GET['id']) || !is_loged_in()){
    header('location: ../');
}
$sql_photo = "DELETE FROM gallery_photo WHERE gallery_id=$_GET[id]";
$sql = "DELETE FROM gallery WHERE id=$_GET[id]";

if ($conn->query($sql_photo) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
} else {
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    } else {
        header('location: ../admin-panel/photo-gallery/');
    }
}


