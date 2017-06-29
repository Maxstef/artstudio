<?php

require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

$conn = connect_to_db();       
$sql = "SELECT * FROM post ORDER BY date";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="uk">
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
                <h3 class="title">Список новин</h3>
             </div>
            <ul class="list-group">
                <li class='list-group-item list-group-item-action'>
                    <span style="position: absolute; left:  1%;">Заголовок, Дата додавання</span>
                    <span style="position: absolute; left:  67%;">Опублікувати</span>
                    <span style="position: absolute; left:  80%;">На головну</span>
                    <span style="position: absolute; left:  95%;">Видалити</span>
                </li>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <li class='list-group-item list-group-item-action'>
                                <a style='width: 60%' href='../add-news?id=$row[id]'> $row[title], $row[date]</a>
                                <div style='position: absolute; left: 70%' class='form-group' id='news-$row[id]' onclick='publish_post($row[id])'>
                                    <input type='checkbox' class='checkbox'";
                                    if($row['published']){
                                        echo "checked='checked'";
                                    }
                                    echo "/>
                                    <label for='published'></label>
                                  </div>
                                <input id='on-main-$row[id]' style='position: absolute; left: 82%' type='checkbox' onclick='onMain($row[id])'";
                                    if($row['on_main']){
                                        echo "checked='checked'";
                                    }
                                    echo "/>
                                <a class='news-list-delete-btn' onclick='confirmDeletePost(event)' href='../../actions/delete_post.php?id=$row[id]'><button class='btn btn-sm btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                            </li>
                            
                        ";
                    }
                } else {
                    echo "<p class='alert alert-info'>Ви не додали жодної новини</p>";
                } 
            ?>
            </ul>
            <a href='../add-news'><button class="btn btn-marg btn-success">Додати</button></a>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
