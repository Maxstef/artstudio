<?php
    require '../config/config.php';
?>

<!DOCTYPE html>
<html lang="uk">
    <?php require '../shared/head.php'?>
    <body>
        <?php require '../shared/navbar.php'?>
        
        <div class="container" style="margin-top: 150px">
            <h4>м. Чернівці, вул. Тихоріцька 22</h4>
            <div id="map" class="map"></div>
        </div>
        
        <?php require '../shared/scripts.php'?>
        <script>
            function myMap() {
                var cor = {
                    lat: 48.289833,
                    lon: 25.969203
                };
                var mapOptions = {
                    center: new google.maps.LatLng(cor.lat, cor.lon),
                    zoom: 16,
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
