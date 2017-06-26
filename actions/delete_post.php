<?php

    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_GET['id']) || !is_loged_in()){
    header('location: ../');
}
$sql = "DELETE FROM post WHERE id=$_GET[id]";
if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
} else {
    header('location: ../admin-panel/news/');
}

