<?php
    
require '../config/config.php';
require '../shared/function.php';


if(isset($_GET['id'])){
    $conn = connect_to_db();
    $sql = "SELECT * FROM post WHERE id=$_GET[id]";
    $result = $conn->query($sql);
    $sql_last = "SELECT * FROM post WHERE published=1 ORDER BY date DESC LIMIT 1";
    $last = $conn->query($sql_last);

    while($row = $result->fetch_assoc()) {
        $title = htmlspecialchars($row['title']);
        $photo = htmlspecialchars($row['photo']);
        $text = htmlspecialchars($row['text']);
        $texts = explode("\n",$text);
        $date = htmlspecialchars($row['date']);
    }

    while($row = $last->fetch_assoc()) {
        $last_title = htmlspecialchars($row['title']);
        $last_photo = htmlspecialchars($row['photo']);
        $last_text = htmlspecialchars($row['text']);
        $last_date = htmlspecialchars($row['date']);
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
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="news-details">
                        <div class="news-details-img-wrapper">
                            <img class="news-details-img" src="<?php echo "../" . $post_photo_dir . $photo;?>" alt="<?php echo $title . ' картинка'; ?>">
                        </div>
                        <div class="news-details-title-wrapper">
                            <h1><?php echo $title;?></h1>
                        </div>
                        <div class="news-details-date-wrapper">
                            <h5>Додано - <?php echo $date;?></h5>
                        </div>
                        <div class="news-details-text-wrapper">
                            <?php
                                foreach($texts as $p){
                                    echo "<p>$p</p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 padd-bott">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <?php require '../shared/contact_widget.php'?>
                        </div>
                        <div class="hidden-md-down col-md-4 col-lg-12">
                            <?php require '../shared/calendar_widget.php'?>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div id="more-news-widget" class="more-news">
                                <a href="../news-list">
                                <div class="hover-effect">
                                </div>
                                <div class="more-news-text">
                                    <h6>Більше новин</h6>
                                </div>
                                <div class="more-news-image-wrapper">
                                    <img src="<?php echo "../" . $post_photo_dir . $last_photo;?>" alt="<?php echo $last_title . ' картинка';?>">
                                </div>
                                <h6 style="margin: 0 10px;color:  black"><?php echo $last_title;?></h6>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php require '../shared/subscribe_form.php'?>
         </div>
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php'?>
    </body>
</html>
