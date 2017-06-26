<?php

require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

$conn = connect_to_db();       
$sql = "SELECT * FROM post";
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
            <div class="news-list">

            <?php
                if ($result->num_rows > 0) {
                    $index = 1;
                    while($row = $result->fetch_assoc()) {
                        echo 
                        "<div class='news-item row'>
                            <h5>$row[title]</h5>    
                            <a href='../../actions/delete_post.php'><button><i class='fa fa-trash' aria-hidden='true'></i></button></a>
                        <div>";                              
                        $index++;
                    }
                } else {
                    echo "<p class='alert alert-info'>Ви не додали жодної новини</p>";
                } 
            ?>
            </div>
            <a href='../add-news'><button class="btn btn-success">Додати</button></a>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
