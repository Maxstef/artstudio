<?php

require '../config/config.php';
require '../shared/function.php';
if(is_loged_in()){
    header('location: ../admin-panel');
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['new-email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = connect_to_db();       
    $sql = "SELECT * FROM admin";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['email'] == $email && $row['password'] == $password && $row['email_verified'] == TRUE){   
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
            }
        }
    }
    if(is_loged_in()){
        header('location: ../admin-panel');
    } else {
        $login_error = 'Wrong email or password';
    }
} /*else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new-email'])) {
    $conn = connect_to_db();
    $new_email =  $_POST['new-email'];
    $headers = "From: ArtStudio\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message = "<div>to confirm press button <button>confirm</button></div>";
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $date = new DateTime();
    $date->add(new DateInterval('PT1H'));
    $token_expired = $date;
    if(mail($new_email,'Новий адмін',$message, $headers)){
        $sql = "INSERT INTO admin (email, email_verified, token, token_expired) VALUES ($email, false, $token, $token_expired)";
        if($conn->query($sql) === FALSE) {
            $error_with_send_mail = "Виникла помилка";
        } else {
            $new_admin_success = "Для підтвердження email повідомлення відправлено на вашу пошту";
        }
    } else {
        $error_with_send_mail = "Виникла помилка при відправленні email";
    }
    
}*/ else {
    $conn = connect_to_db();     
    $sql = "SELECT * FROM admin";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $no_admin = TRUE;
    } else {
        $no_admin = TRUE;
        while($row = $result->fetch_assoc()) {
            if($row['email_verified'] == TRUE){ 
                 $no_admin = FALSE;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="uk">
    <?php require '../shared/head.php'?>
    <body>
        <?php require '../shared/navbar.php'?>
        <div class='container'>
            
            <!--<?php if(isset($no_admin)){
                echo "<p class='text-center alert alert-danger'>Жодного адміна не було додано</p>
                <form action='' method='post'><div class='form-group'><label for='new-email'>Email</label>  
                <input class='form-control' name='new-email' id='new-email' placeholder='email...'></div> <button type='submit' class='btn btn-primary'>
                Додати</button></form>";
            }?>
            <?php if(isset($error_with_send_mail)){echo "<p class='alert alert-danger'>$error_with_send_mail</p>";}?>
            <?php if(isset($new_admin_success)){echo "<p class='alert alert-success'>$new_admin_success</p>";}?>-->
            <div class="container login-form-container">
                <form action="" method="post" class="login-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" id="email" placeholder="email...">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="password...">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <?php if(isset($login_error)){echo "<p class='alert alert-danger'>$login_error</p>";}?>
            </div>
        </div>
        
        
        <?php require '../shared/scripts.php'?>
    </body>
</html>
