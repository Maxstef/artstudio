<?php
    
require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer']) ){
    $conn = connect_to_db();
    if(isset($_POST['published'][0])){
        $published = $_POST['published'][0];
    } else {
        $published = 0;
    } 
    $answer = str_replace("'", '"', $_POST['answer']);
    $sql_answer = "UPDATE question SET answer='$answer', published=$published WHERE id=$_GET[id]";
    if ($conn->query($sql_answer) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    } else {
        header('location: ../admin-question');
    }
}

if(isset($_GET['id'])){
    $conn = connect_to_db();
    $sql = "SELECT * FROM question WHERE id=$_GET[id]";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $question = htmlspecialchars($row['question']);
        if(isset($row['answer']) && $row['answer']) {
            $answer = $row['answer'];
        } else {
            $answer = '';
        }
        $author = htmlspecialchars($row['author']);
        $author_contacts = htmlspecialchars($row['author_contacts']);
        $date = htmlspecialchars($row['date']);
        $done = $row['done'];
        $published = $row['published'];
    }
    if(!$done){
        $sql_done = "UPDATE question SET done=1 WHERE id=$_GET[id]";
        if ($conn->query($sql_done) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
        }
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
                <h3 class="title">
                    Відповісти на питання
                </h3>
            </div>
            <div class="container question">
                <h5 class="bottom-divider" style="line-height: 1.3;"><?php echo $question;?></h5>
                <p>Автор - <?php echo $author;?></p>
                <p>Контакти - <?php echo $author_contacts;?></p>
                <p class="bottom-divider">Дата додавання - <?php echo $date;?></p>
                <form action="" method="post" class="answer-form">
                    <div class="form-group">
                        <label for="answer">Відповідь:</label>
                        <textarea class="form-control" name="answer" id="answer" rows="7" required><?php echo $answer;?></textarea>
                    </div>
                    <div class="form-group">
                             <input type="checkbox" class="checkbox" name="published" value="1" id="published"
                                    <?php if($published){
                                         echo " checked ";
                                     }?>
                             />
                        <label for="published">Опублікувати</label>
                    </div>
                    <button type="submit" class="btn btn-marg btn-primary">Зберегти</button>
                </form>
            </div>
        </div>
        <?php require '../../shared/footer.php'?>
        
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
