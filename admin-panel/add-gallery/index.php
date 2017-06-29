<?php
    
error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

if(isset($_GET['id'])){
    $can_add_photo = TRUE;
    $conn = connect_to_db();
    $sql = "SELECT * FROM gallery WHERE id=$_GET[id]";
    $result = $conn->query($sql);
    $sql_photo = "SELECT * FROM gallery_photo WHERE gallery_id=$_GET[id]";
    $photos = $conn->query($sql_photo);
} else {
    $can_add_photo = FALSE;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['id'])){
    $conn = connect_to_db();
    $title = str_replace("'", '"', $_POST['title']);
    $description = str_replace("'", '"', $_POST['description']);
    if(isset($_POST['published'][0])){
        $published = $_POST['published'][0];
    } else {
        $published = 0;
    }   
    $sql = "INSERT INTO gallery (title, description, published, date) VALUES ('$title', '$description', $published, now())";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
    header('location: ../photo-gallery');
    
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])){
    $conn = connect_to_db();
    $title = str_replace("'", '"', $_POST['title']);
    $description = str_replace("'", '"', $_POST['description']);
    if(isset($_POST['published'][0])){
        $published = $_POST['published'][0];
    } else {
        $published = 0;
    }
    $sql = "UPDATE gallery SET published=$published, title='$title', description='$description' WHERE id=$_GET[id]";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    } else {
        header('location: ../photo-gallery');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
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
                <h3 class="title"><?php if (isset($result) && $result->num_rows > 0) {
                        echo "Редагувати галерею";
                    } else {
                        echo "Додати галерею";
                    }?>
                </h3>
             </div>
            <?php if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                        <form action="" method="post" class="edit-gallery-form">
                          <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input class="form-control" name="title" id="title" value="' . $row["title"] . '" required>
                          </div>
                          <div class="form-group">
                            <label for="description">Опис</label>
                            <textarea class="form-control" name="description" id="description" rows="3" required>' . $row["description"] . '</textarea>
                          </div>
                          <div class="form-group">
                             <input type="checkbox" class="checkbox" name="published" value="1" id="published"';
                             if($row['published']){
                                 echo " checked ";
                             }
                             echo ' />
                             <label for="published">Опублікувати</label>
                          </div>
                          <button type="submit" class="btn btn-primary">Зберегти</button>
                        </form>
                    ';
                }
                
            } else {
                echo '
                    <form action="" method="post" class="new-gallery-form">
                      <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input class="form-control" name="title" id="title" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Опис</label>
                        <textarea class="form-control" name="description" id="description" rows="10" required></textarea>
                      </div>
                      <div class="form-group">
                         <input type="checkbox" class="checkbox" name="published" value="1" id="published" />
                         <label for="published">Опублікувати</label>
                      </div>
                      <button type="submit" class="btn btn-primary">Зберегти</button>
                    </form>
                ';
            }?>
            <?php
                if($can_add_photo === FALSE){
                    echo "<p class='alert alert-info' style='margin: 20px'>Збережеть галерею для можливості додавання фото!</p>";
                } else {
                    echo "
                        <div class='photo-list' style='margin-top:30px'>
                           <h4>Зображення</h4>
                           <form action='' method='post class='new-image-form'>
                                <div class='form-group row'>
                                    <div class='col-12 col-md-8'>
                                        <label for='upload-image'>Додати зображення</label>
                                        <input type='file' class='form-control' name='image' id='upload-image' accept='image/*'>
                                    </div>
                                    <div class='col-12 col-md-4' style='position: relative'>
                                        <button type='button' class='btn btn-primary' style='margin-top: 35px' id='upload-btn' onclick='upload(" . '"gallery"' . ", $_GET[id])'>Завантажити</button>
                                        <p class='loader' id='upload-loading'></p>
                                    </div> 
                                </div> 
                           </form>
                           <div id='images-container' class='images-container row'>";
                           if (isset($photos) && $photos->num_rows > 0) {
                                while($row = $photos->fetch_assoc()) {
                                    echo "
                                        <div class='col-12 col-md-6 col-lg-4 image-gallery-wrapper' id='image-$row[id]'>
                                            <div class='delete-icon' onclick='deleteImg($row[id])'>
                                                <i  class='fa fa-2x fa-window-close' aria-hidden='true'></i>
                                            </div>
                                            <img src='../..$gallery_photo_dir$row[photo]' alt='gallery-image' style='width: 100%'>
                                        </div>
                                    ";
                                }
                           }
                           echo "</div>
                        </div>
                    ";
                }
            ?>
            
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
     
</html>
