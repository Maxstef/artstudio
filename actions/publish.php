<?php
    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_POST['id']) || (!isset($_POST['published']) || !isset($_POST['onmain'])) || !is_loged_in()){
    header('location: ../');
}
if(isset($_POST['published'])){
    $sql = "UPDATE post SET published=$_POST[published] WHERE id=$_POST[id]";
}
if(isset($_POST['onmain'])){
    $sql = "UPDATE post SET on_main=$_POST[onmain] WHERE id=$_POST[id]";
}

if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
}

echo "success!";
