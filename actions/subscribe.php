<?php
    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_POST['email'])){
    header('location: ../');
}
$sql = "SELECT * FROM subscriber WHERE email='$_POST[email]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $delete_sql = "DELETE FROM subscriber WHERE email='$_POST[email]'";
    if ($conn->query($delete_sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    } else {
        echo "Ви успішно відписалися від новин і розсилкок";
    }
} else {
    $insert_sql = "INSERT INTO subscriber(email, date) VALUES ('$_POST[email]', now())";
    if ($conn->query($insert_sql) === FALSE) {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
        die();
    } else {
        echo "Ви успішно підписалися на новини і розсилки";
    }
}
