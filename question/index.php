<?php

require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();
$sql = "SELECT * FROM question WHERE published=1 ORDER BY date DESC";
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
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "
                                    <div class='card space-bottom'>
                                      <div class='card-block'>
                                        <div class='card-block-question'>
                                            <h6>Питання:</h6>
                                            <p>$row[question]</p>
                                        </div>
                                        <div class='card-block-answer'>
                                            <h6>Відповідь:</h6>
                                            <p>$row[answer]</p>
                                        </div>
                                      </div>
                                    </div>
                                ";
                            }
                        } else {
                            echo "<p class='alert alert-info'>Жодного питання не опубліковано</p>";
                        }
                    ?>
                </div>
            </div>
            
        </div>
        
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
    </body>
</html>
