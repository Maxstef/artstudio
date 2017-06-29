<?php

    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_POST['id']) || !is_loged_in()){
    header('location: ../');
}
$sql_photo = "DELETE FROM gallery_photo WHERE id=$_POST[id]";

if ($conn->query($sql_photo) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
} else {
   echo "deleted";
}


