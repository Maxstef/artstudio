
<?php
    $route = $_SERVER['REQUEST_URI'];
?>
<nav class="navbar navbar-toggleable-sm navbar-inverse bg-danger padding-0">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="<?php if($route == '/admin-panel/'){echo './';} else {echo '../';}?>">Червоний квадрат</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto nav-height">
                <li class="nav-item <?php if($route == '/admin-panel/news'){echo 'active';}?>">         
                    <a class="nav-link" href="<?php if($route == '/admin-panel/'){echo './news';} else {echo '../news';}?>">Новини</a>
                </li>
                <li class="nav-item <?php if($route == '/admin-panel/photo-gallery'){echo 'active';}?>">
                    <a class="nav-link" href="<?php if($route == '/admin-panel/'){echo './photo-gallery';} else {echo '../photo-gallery';}?>">Фотогалереї</a>
                </li>
                <li class="nav-item <?php if($route == '/admin-panel/admin-question'){echo 'active';}?>">
                    <a class="nav-link" href="<?php if($route == '/admin-panel/'){echo './admin-question';} else {echo '../admin-question';}?>">Питання</a>
                </li>
                <li class="nav-item <?php if($route == '/admin-panel/new-mail'){echo 'active';}?>">
                    <a class="nav-link" href="<?php if($route == '/admin-panel/'){echo './new-mail';} else {echo '../new-mail';}?>">Розсилка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php if($route == '/admin-panel/'){echo '../';} else {echo '../../';}?>">Сайт</a>
                </li>
                
            </ul>
            <ul class="navbar-nav nav-height pull-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="./" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['email'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php if($route == '/admin-panel/'){echo '../actions/logout.php';} else {echo '../../actions/logout.php';}?>">Вийти</a>
                    </div>
                </li>
            </ul>
                 
            </div>
        </nav>