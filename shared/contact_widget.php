<?php
    $route = $_SERVER['REQUEST_URI'];
?>
<div class="contact-widget">
    <h4 class="contact-widget-title">Наші Контакти</h4>
    <div class="contact-widget-item">
        Адреса - <?php echo $address;?>
    </div>
    <div class="contact-widget-item">
        Телефон - <?php echo $tel_number;?>
    </div>
    <div class="contact-widget-item">
        Електронна пошта - <?php echo $email;?>
    </div>
    <?php if($route != '/contact/'){
         echo '<div class="contact-widget-item">
            <a class="red-hyper" href="../contact">Контакти</a>
        </div>';
    }?>
    
</div>
