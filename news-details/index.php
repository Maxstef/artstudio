<?php
    
require '../config/config.php';
require '../shared/function.php';


if(isset($_GET['id'])){
    $conn = connect_to_db();
    $sql = "SELECT * FROM post WHERE id=$_GET[id]";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $title = $row['title'];
        $photo = $row['photo'];
        $text = $row['text'];
        $date = $row['date'];               
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
                <h3 class="title">Художня студія "Червоний Квадрат"</h3>
             </div>
         </div>
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
    </body>
</html>
