<?php

?>

<!DOCTYPE html>
<html lang="en">
    <?php require '../shared/head.php'?>
    <body>
        <?php require '../shared/navbar.php'?>
        <div class="container login-form-container">
            <form action="" method="post" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" name="username" id="username" placeholder="username...">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="password...">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        
        <?php require '../shared/scripts.php'?>
    </body>
</html>
