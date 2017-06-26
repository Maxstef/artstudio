<?php
    
error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $conn = connect_to_db();
    $title = str_replace("'", '"', $_POST['title']);
    $text = str_replace("'", '"', $_POST['text']);
    $photo = $_POST['photo'];
    if(isset($_POST['published'][0])){
        $published = $_POST['published'][0];
    } else {
        $published = 0;
    }   
    $sql = "INSERT INTO post (title, text, photo, published, date) VALUES ('$title', '$text', '$photo', $published, now())";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
    header('location: ../news');
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php require '../../shared/head.php'?>
    <body>
        <?php require '../shared/admin-navbar.php';?>
        <div class="container">
            <div class="breadcrumb">
                <h3 class="title">Додати новину</h3>
             </div>
            <form action="" method="post" class="new-post-form" enctype='multipart/form-data'>
              <div class="form-group">
                <label for="title">Заголовок</label>
                <input class="form-control" name="title" id="title" required>
              </div>
              <div class="form-group">
                <label for="text">Текст</label>
                <textarea class="form-control" name="text" id="text" rows="10" required></textarea>
              </div>
              <div class="form-group row">
                <div class="col-9">
                    <label for="upload-image">Зображення</label>
                    <input type="file" class="form-control" name="image" id="upload-image">
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-primary" style="margin-top: 35px" id="upload-btn">Завантажити</button>
                </div>  
              </div>
              <p class="alert alert-danger" id="no-file">Виберіть файл для того щоб завантажити!</p>
              <div id="success-upload">
                  <img id="uploaded-img" width="200"/><p class="alert alert-success">Зображення збережено</p>
              </div>
              
              <div class="form-group">
                 <input type="checkbox" class="checkbox" name="published" value="1" id="published" accept="image/*" />
                 <label for="published">Опублікувати</label>
              </div>
              <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
     
</html>
