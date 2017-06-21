<?php

require '../config/config.php';
require '../shared/function.php';
if(is_loged_in()){
    header('location: ../admin-panel');
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = connect_to_db();         
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['email'] == $email && $row['password'] == $password){   
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
            }
        }
    }
    if(is_loged_in()){
        header('location: ../admin-panel');
    } else {
        $status = 'Wrong email or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php require '../shared/head.php'?>
    <body>
        <?php require '../shared/navbar.php'?>
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
            <?php if(isset($status)){echo "<p class='alert alert-danger'>$status</p>";}?>
        </div>
        
        
        <?php require '../shared/scripts.php'?>
    </body>
</html>
