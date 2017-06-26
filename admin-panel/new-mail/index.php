<?php
    
error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}


?>

<!DOCTYPE html>
<html lang="uk">
    <?php require '../../shared/head.php'?>
    <body>
        <?php require '../shared/admin-navbar.php';?>
        <div class="container">
            mail
        </div>
        <?php require '../../shared/footer.php'?>
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
