<?php
    
error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../../config/config.php';
require '../../shared/function.php';

if(!is_loged_in()){
    header('location: ../../y-admin');
}

$conn = connect_to_db();

$sql = "SELECT * FROM subscriber ORDER BY email";

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
                <h3 class="title">Розсилка</h3>
             </div>
            <div class="row">
                <div class="col-12 col-md-9">
                    <form class="mail-form" id="mail-form" onsubmit="sendMail(event)">
                        <h4>Нова розсилка:</h4>
                        <div class="form-group">
                            <label for="mail-form-name">Тема:</label>
                            <input id="mail-form-name" maxlength="100" name="theme" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mail-form-message">Повідомлення:</label>
                            <textarea id="mail-form-message" name="message" class="form-control" rows="8" required></textarea>
                        </div>
                        <button id="mail-form-submit-btn" type="submit" class="btn-marg btn btn-danger">Надіслати</button>
                        <div class="loader" id="mail-loader"></div>
                        <p id="mail-form-feedback" class="alert alert-success"></p>
                    </form>
                </div>
                <div class="col-12 col-md-3">
                    <h5>Підписані на розсилку:</h5>
                    <ul class="list-group">                    
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<li class='list-group-item sm-pad'>$row[email]</li>";
                            }
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php require '../../shared/footer.php'?>
        <?php require '../../shared/scripts.php'?>
    </body>
</html>
