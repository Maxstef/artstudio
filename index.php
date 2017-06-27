<?php

require './config/config.php';
require './shared/function.php';

$conn = connect_to_db();
$sql = "SELECT * FROM post WHERE published=1 AND on_main=1";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="../../favicon.png" />
        <title>Художня студія Червоний квадрат</title>
        <meta name="description" content="Художня студія Червоний квадрат місто Чернівці">
        <meta name="keywords" content="художня студія, чернівці, червоний квадрат, художня студія чернівці">
        <?php require './shared/styles.php'?>
    </head>
    <body>
        <?php require './shared/navbar.php'?>
        <div class="container">
            <div class="breadcrumb">
                <h1 class="title">Художня студія "Червоний Квадрат"</h1>
             </div>
            <div class="row">
                <div class="col-12 col-lg-9">
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "
                                    <div class='row'>
                                        <div class='main-page-item'>
                                            <a href='./news-details?id=$row[id]'>
                                            <div class='col-12 img-wrapper'>
                                                <div class='painted-black'></div>
                                                <img class='main-page-img' src='./uploaded/$row[photo]' alt='$row[title] картинка'>
                                                <h3 class='main-page-item-title'>$row[title]</h3>
                                            </div>
                                            <p class='main-page-item-text'>"; echo mb_substr($row['text'], 0, 200) . '...'; echo"</p>
                                            </a>
                                        </div>
                                        
                                    </div>
                                ";
                            }
                        }
                    ?>
                </div>
                <div class="col-12 col-lg-3 padd-bott">
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <?php require './shared/contact_widget.php'?>
                        </div>
                        <div class="hidden-sm-down col-md-4 col-lg-12">
                            <?php require './shared/calendar_widget.php'?>
                        </div>
                    </div>
                </div>
            </div>
            <?php require './shared/subscribe_form.php'?>
        </div>
        <?php require './shared/footer.php'?>
        <?php require './shared/scripts.php'?>
    </body>
</html>
