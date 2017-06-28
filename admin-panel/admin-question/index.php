<?php

require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

$conn = connect_to_db();

$sql = "SELECT * FROM question ORDER BY date DESC";

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
                <h3 class="title">Питання</h3>
             </div>
             <ul class="list-group">
                <li class='list-group-item list-group-item-action'>
                    <span style="position: absolute; left:  1%;">Заголовок, Дата публікації</span>
                    <span style="position: absolute; left:  77%;">Опублікувати</span>
                    <span style="position: absolute; left:  95%;">Видалити</span>
                </li>
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "
                                <li class='list-group-item list-group-item-action'>
                                    <a style='width: 60%' href='../answer?id=$row[id]'>";
                                    if(!$row['done']){
                                        echo "<i style='color: red' class='fa fa-exclamation fa-lg' aria-hidden='true'></i>";
                                    }
                                    echo " $row[question], $row[date]</a>
                                    <div style='position: absolute; left: 80%' class='form-group' id='question-$row[id]' onclick='publish_question($row[id])'>
                                        <input type='checkbox' class='checkbox'";
                                        if($row['published']){
                                            echo "checked='checked'";
                                        }
                                        echo "/>
                                        <label for='published'></label>
                                      </div>
                                    <a class='news-list-delete-btn' onclick='confirmDeleteQuestion(event)' href='../../actions/delete_question.php?id=$row[id]'><button class='btn btn-sm btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                                </li>
                            
                            ";
                        }
                    } else {
                        echo "<p class='alert alert-info'>Немає питань</p>";
                    } 
                ?>
            </ul>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
