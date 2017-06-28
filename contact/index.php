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
                <h2 class="title">Контакти</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php require '../shared/contact_widget.php'?>
                </div>
                <div class="col-12">
                    <div class="space-top space-bottom">
                        <h4><?php echo $address;?></h4>
                        <div id="map" class="map"></div>
                    </div>
                </div>
                <div class="col-12">
                    <?php require '../shared/contact_form.php'?>
                </div>
            </div>
        </div>
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
        <script>
            function myMap() {
                var cor = {
                    lat: 48.289833,
                    lon: 25.969203
                };
                var mapOptions = {
                    center: new google.maps.LatLng(cor.lat, cor.lon),
                    zoom: 17,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                var marker = new google.maps.Marker({
                  position: {lat: cor.lat, lng: cor.lon},
                  map: map
                });
            }
        </script>
        <?php echo '<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=' . $googleApiKey . '"></script>';?>
        
    </body>
</html>
