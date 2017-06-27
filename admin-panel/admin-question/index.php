<?php

require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

?>

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="../../favicon.png" />
        <title>Художня студія Червоний квадрат</title>
        <?php require '../../shared/styles.php'?>
    </head>
    <body>
        <?php require '../shared/admin-navbar.php';?>
        <div class="container">
            <div class="breadcrumb">
                <h3 class="title">Питання</h3>
             </div>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
