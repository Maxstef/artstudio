<?php

require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['new-email'])){
    
}

$conn = connect_to_db();       
$sql = "SELECT * FROM post ORDER BY date";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="uk">
    <?php require '../../shared/head.php'?>
    <body>
        <?php require '../shared/admin-navbar.php';?>
        <div class="container">
            <div class="breadcrumb">
                <h3 class="title">Список новин</h3>
             </div>
            <ul class="list-group">
                <li class='list-group-item list-group-item-action'>
                    <span style="position: absolute; left:  1%;">Заголовок, Дата публікації</span>
                    <span style="position: absolute; left:  67%;">Опублікувати</span>
                    <span style="position: absolute; left:  90%;">Видалити</span>
                </li>

            <?php
                if ($result->num_rows > 0) {
                    $index = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <li class='list-group-item list-group-item-action'>
                                <a href='../add-news?id=$row[id]'> $row[title], $row[date]</a>
                                <div style='position: absolute; left: 70%' class='form-group' id='news-$row[id]' onclick='publish($row[id])'>
                                    <input type='checkbox' class='checkbox'";
                                    if($row['published']){
                                        echo "checked='checked'";
                                    }
                                    echo "/>
                                    <label for='published'></label>
                                  </div>
                                
                                <a class='news-list-delete-btn' onclick='confirmDeletePost(event, \"" .  $row["title"] .  "\")' href='../../actions/delete_post.php?id=$row[id]'><button class='btn btn-sm btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                            </li>
                            
                        ";                            
                        $index++;
                    }
                } else {
                    echo "<p class='alert alert-info'>Ви не додали жодної новини</p>";
                } 
            ?>
            </ul>
            <a href='../add-news'><button class="btn btn-success">Додати</button></a>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
        <script>
            function confirmDeletePost(e, title){
                if(!confirm('Ви впевнeні що хочете видалити новину ' + title)){
                    e.preventDefault();
                }
            }
        </script>
    </body>
</html>
