<?php
    session_start();
    $route = $_SERVER['REQUEST_URI'];
?>
<nav class="navbar navbar-toggleable-sm navbar-inverse bg-danger padding-0">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="../">Червоний квадрат</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto nav-height">
        <li class="nav-item <?php if($route == '/'){echo 'active';}?>">         
            <a class="nav-link" href="../">Головна</a>
        </li>
        <li class="nav-item <?php if(strpos($route, '/teacher/') !== false){echo 'active';}?>">
            <a class="nav-link" href="../teacher">Викладачі</a>
        </li>
        <li class="nav-item <?php if(strpos($route, '/news-list/') !== false){echo 'active';}?>">
            <a class="nav-link" href="../news-list">Новини</a>
        </li>
        <li class="nav-item <?php if(strpos($route, '/gallery-list/') !== false){echo 'active';}?>">
            <a class="nav-link" href="../gallery-list">Фотогалереї</a>
        </li>
        <li class="nav-item <?php if(strpos($route, '/question/') !== false){echo 'active';}?>">
            <a class="nav-link" href="../question">Питання</a>
        </li>
        <li class="nav-item <?php if(strpos($route, '/contact/') !== false){echo 'active';}?>">
            <a class="nav-link" href="../contact">Контакти</a>
        </li>
        
    </ul>
        <?php 
            if(isset($_SESSION['email'])){
                echo '<ul class="navbar-nav nav-height pull-right"><li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="./" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                echo    $_SESSION['email'];
                echo '</a><div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"><a class="dropdown-item" href="../admin-panel">Адмін панель</a><a class="dropdown-item" href="../actions/logout.php">Вийти</a></div></ul>';
            }
        ?>
        
    </div>
</nav>