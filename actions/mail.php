<?php

require '../config/config.php';
require '../shared/function.php';

if(!is_loged_in() || !isset($_POST['theme']) || !isset($_POST['message'])){
    header('location: ../y-admin');
}

$conn = connect_to_db();
$sql = "SELECT * FROM subscriber ORDER BY email";
$result = $conn->query($sql);

echo "Розсилка успішно завершена";