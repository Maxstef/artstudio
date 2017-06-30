<?php

    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_POST['id']) || !is_loged_in()){
    header('location: ../');
}
$sql = "SELECT * FROM gallery_photo WHERE id=$_POST[id]";
$sql_photo = "DELETE FROM gallery_photo WHERE id=$_POST[id]";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $file = '..' . $gallery_photo_dir . $row['photo'];
    }
} else {
    die();
}


if ($conn->query($sql_photo) === FALSE) {
    echo "Error: " . $sql_photo . "<br>" . $conn->error;
    die();
} else {
    unlink($file);
    echo "deleted";
}


