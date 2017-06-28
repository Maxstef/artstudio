<?php

require '../config/config.php';

?>

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="../../favicon.png" />
        <title>Художня студія Червоний квадрат</title>
        <meta name="description" content="Художня студія Червоний квадрат місто Чернівці">
        <meta name="keywords" content="художня студія, чернівці, червоний квадрат, художня студія чернівці">
        <?php require '../shared/styles.php'?>
    </head>
    <body>
        <?php require '../shared/navbar.php'?>
        
        <div class="container">
            <div class="breadcrumb">
                <h2 class="title">Питання</h2>
            </div>
            <h4 style="padding:  15px">Ви можете задати нам питання у формі для зв'язку з нами</h4>
            <div class="row ordered">
                <div class="col-12 col-lg-9 ">
                    <?php require '../shared/contact_form.php'?>
                </div>    
                <div class="col-12 col-lg-3 md-down">
                    <?php require '../shared/contact_widget.php'?>
                </div>
                <div class="col-12 md-up">
                    Список питань!!!
                </div>
            </div>
            
        </div>
        
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
    </body>
</html>
