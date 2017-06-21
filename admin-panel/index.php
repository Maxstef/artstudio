<?php
    
require '../config/config.php';
require '../shared/function.php';

if(!is_loged_in()){
    header('location: ../y-admin');
}

?>

<!DOCTYPE html>
<html lang="uk">
    <?php require '../shared/head.php';?>
    <body>
        
        <?php require './shared/admin-navbar.php';?>
        <h1>Hello admin</h1>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
