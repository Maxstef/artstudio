<?php
    
require '../config/config.php';
require '../shared/function.php';


if(isset($_GET['id'])){
    $conn = connect_to_db();
    $sql = "SELECT * FROM gallery WHERE id=$_GET[id]";
    $sql_photo = "SELECT * FROM gallery_photo WHERE gallery_id=$_GET[id]";
    $result = $conn->query($sql);
    $photos = $conn->query($sql_photo);

    while($row = $result->fetch_assoc()) {
        $title = htmlspecialchars($row['title']);
        $description = htmlspecialchars($row['description']);
        $date = htmlspecialchars($row['date']);
    }

}


?>

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="../../favicon.png" />
        <title><?php echo $title;?></title>
        <meta name="description" content='<?php echo $title;?>'>
        <meta name="keywords" content="художня студія, чернівці, червоний квадрат, художня студія чернівці">
        <?php require '../shared/styles.php'?>
    </head>
    <body>
        <?php require '../shared/navbar.php'?>
        <div class="container">
            <div class="breadcrumb">
                <h2 class="title">Художня студія "Червоний Квадрат"</h2>
             </div>
            <div class="row">
                <div class='col-12'>
                    <h3><?php echo $title;?></h3>
                    <p><?php echo $description;?></p>
                </div>
              
              <?php
                   if ($photos->num_rows > 0) {
                            while($row = $photos->fetch_assoc()) {
                                echo "
                                    <div class='col-12 space-bottom'>
                                        <img class='image-gallery' src='..$gallery_photo_dir$row[photo]' alt='$title фото'>
                                    </div>
                                ";
                            }
                   }
              ?>
            </div>
            <?php require '../shared/subscribe_form.php'?>
         </div>
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
    </body>
</html>
