<?php
    
error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

if(isset($_GET['id'])){
    $conn = connect_to_db();
    $sql = "SELECT * FROM post WHERE id=$_GET[id]";
    $result = $conn->query($sql);
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['id'])){

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

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])){
    $conn = connect_to_db();
    $title = str_replace("'", '"', $_POST['title']);
    $text = str_replace("'", '"', $_POST['text']);
    if(isset($_POST['photo'])){
        $photo = $_POST['photo'];
    }   
    if(isset($_POST['published'][0])){
        $published = $_POST['published'][0];
    } else {
        $published = 0;
    }
    if(isset($photo)){
        $sql = "UPDATE post SET photo='$photo', published=$published, title='$title', text='$text' WHERE id=$_GET[id]";
    } else {
        $sql = "UPDATE post SET published=$published, title='$title', text='$text' WHERE id=$_GET[id]";
    }
    
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    } else {
        header('location: ../news');
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
                        echo "Редагувати новину";
                    } else {
                        echo "Додати новину";
                    }?>
                </h3>
             </div>
            <?php if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                        <form action="" method="post" class="edit-post-form">
                          <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input class="form-control" name="title" id="title" value=' . "'" . $row["title"] . "'" . ' required>
                          </div>
                          <div class="form-group">
                            <label for="text">Текст</label>
                            <textarea class="form-control" name="text" id="text" rows="10" required>' . $row["text"] . '</textarea>
                          </div>
                          <div class="form-group">
                            <label>Зображення</label>
                            <div>
                                <img class="saved-img" src="../../' . $post_photo_dir . $row["photo"] . '" />
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-12 col-md-9">
                                <label for="upload-image">Нове зображення</label>
                                <input type="file" class="form-control" name="image" id="upload-image" accept="image/*">
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="button" class="btn btn-primary" style="margin-top: 35px" id="upload-btn" onclick="upload(' . "'post'" . ')">Завантажити</button>
                            </div>
                             
                          </div>
                          <p class="alert alert-danger" id="no-file">Виберіть файл для того щоб завантажити!</p>
                          <div id="success-upload">
                              <img id="uploaded-img" width="200"/><p class="alert alert-success">Зображення збережено</p>
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
                          <a href="../news"><button type="button" class="btn btn-secondary">Відмінити</button></a>
                        </form>
                    ';
                }
                
            } else {
                echo '
                    <form action="" method="post" class="new-post-form">
                      <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input class="form-control" name="title" id="title" required>
                      </div>
                      <div class="form-group">
                        <label for="text">Текст</label>
                        <textarea class="form-control" name="text" id="text" rows="10" required></textarea>
                      </div>
                      <div class="form-group row">
                        <div class="col-12 col-md-9">
                            <label for="upload-image">Зображення</label>
                            <input type="file" class="form-control" name="image" id="upload-image" accept="image/*">
                        </div>
                        <div class="col-12 col-md-3">
                            <button type="button" class="btn btn-primary" style="margin-top: 35px" id="upload-btn"  onclick="upload(' . "'post'" . ')">Завантажити</button>
                        </div>  
                      </div>
                      <p class="alert alert-danger" id="no-file">Виберіть файл для того щоб завантажити!</p>
                      <div id="success-upload">
                          <img id="uploaded-img" width="200"/><p class="alert alert-success">Зображення збережено</p>
                      </div>
              
                      <div class="form-group">
                         <input type="checkbox" class="checkbox" name="published" value="1" id="published" />
                         <label for="published">Опублікувати</label>
                      </div>
                      <button type="submit" class="btn btn-primary">Зберегти</button>
                    </form>
                ';
            }?>
            
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
     
</html>
