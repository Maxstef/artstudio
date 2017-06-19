<?php
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
        <li class="nav-item <?php if($route == '/teacher/'){echo 'active';}?>">
            <a class="nav-link" href="../teacher">Викладачі</a>
        </li>
        <li class="nav-item <?php if($route == '/question/'){echo 'active';}?>">
            <a class="nav-link" href="../question">Питання</a>
        </li>
        <li class="nav-item <?php if($route == '/contact/'){echo 'active';}?>">
            <a class="nav-link" href="../contact">Контакти</a>
        </li>
    </ul>
    </div>
</nav>