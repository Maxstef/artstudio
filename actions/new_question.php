<?php

    
require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();

if(!isset($_POST['name']) || !isset($_POST['contacts']) || !isset($_POST['message'])){
    header('location: ../');
}

$name = str_replace("'", '"', $_POST['name']);
$contacts = str_replace("'", '"', $_POST['contacts']);
$message = str_replace("'", '"', $_POST['message']);
$sql = "INSERT INTO question (question, author, author_contacts, date, done, published) VALUES ('$message', '$name', '$contacts', now(), 0, 0)";

if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
} else {
    echo "Ваше повідомлення збережено. Ми зв'яжемося з вами або надамо відповідь в розділі питання нашого сайту";
}
