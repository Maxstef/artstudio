<?php

require '../config/config.php';
require '../shared/function.php';

$conn = connect_to_db();
$sql = "SELECT gallery.id AS id, title, description, date, COUNT(gallery_photo.id) AS number_of_photo, (SELECT photo FROM gallery_photo WHERE gallery_id=gallery.id LIMIT 1) AS photo 
FROM gallery INNER JOIN gallery_photo ON gallery.id=gallery_photo.gallery_id WHERE gallery.published=1 GROUP BY gallery.id ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="../../favicon.png" />
        <title>Художня студія Червоний квадрат Фотогалереї</title>
        <meta name="description" content="Фотогалереї Художноьї студії Червоний квадрат місто Чернівці">
        <meta name="keywords" content="художня студія фотогоалерея, чернівці, червоний квадрат, художня студія чернівці, фотогаларея">
        <?php require '../shared/styles.php'?>
    </head>
    <body>
        <?php require '../shared/navbar.php'?>
        <div class="container">
            <div class="breadcrumb">
                <h2 class="title">Фотогалереї художньої студії</h2>
             </div>
            <div class="row">
                <div class="col-12 col-lg-9">
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "
                                    <div class='row'>
                                        <div class='main-page-item'>
                                            <a href='../gallery-details?id=$row[id]'>
                                            <div class='col-12 img-wrapper'>
                                                <i class='fa-5x fa fa-camera photo-white' aria-hidden='true'></i>
                                                <div class='painted-black'></div>
                                                <img class='main-page-img' src='..$gallery_photo_dir$row[photo]' alt='" . htmlspecialchars($row['title']) . " картинка'>
                                                <h3 class='main-page-item-title'>" . htmlspecialchars($row['title']) . "</h3>
                                            </div>
                                            <p class='main-page-item-text'>" . mb_substr(htmlspecialchars($row['description']), 0, 200) . '...' . "</p>
                                            <p style='border-bottom: 1px solid #aaa' class='main-page-item-text'>Кількість фото - $row[number_of_photo]</p>
                                            </a>
                                        </div>
                                    </div>
                                ";
                            }
                        } else {
                            echo "<p class='alert alert-info'>На даний момент не опубліковано жодної фотогалереї</p>";
                        }
                    ?>
                </div>
                <div class="col-12 col-lg-3 padd-bott">
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <?php require '../shared/contact_widget.php'?>
                        </div>
                        <div class="hidden-sm-down col-md-4 col-lg-12">
                            <?php require '../shared/calendar_widget.php'?>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../shared/subscribe_form.php'?>
        </div>
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
    </body>
</html>
