<?php
    
require '../config/config.php';
require '../shared/function.php';

if(!is_loged_in()){
    header('location: ../y-admin');
}

?>

<!DOCTYPE html>
<html lang="uk">
    <?php require '../shared/head.php';?>
    <body>
        
        <?php require './shared/admin-navbar.php';?>
            <div class="container space-top">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <h3 class="card-header">Адмін Панель</h3>
                    <div class="card-block">
                      <div class="row">
                        <div class="col-6 col-sm-4 text-center space-top">
                          <a href="./news">
                            <i class="fa fa-newspaper-o fa-3x fa-fw" aria-hidden="true"></i>
                            <h4>Новини</h4>
                          </a>
                        </div>
                        <div  class="col-6 col-sm-4 text-center space-top">
                          <a href="./photo-gallery">
                            <i class="fa fa-picture-o fa-3x fa-fw" aria-hidden="true"></i>
                            <h4>Фотогалереї</h4>
                          </a>
                        </div>
                        <div class="col-6 col-sm-4 text-center space-top">
                          <a href="./admin-question">
                            <i class="fa fa-question-circle fa-3x fa-fw" aria-hidden="true"></i>
                            <h4>Питання</h4>
                          </a>
                          <span class="badge badge-danger counter">0</span>
                        </div>
                        <div class="col-6 col-sm-4 text-center space-top">
                          <a href="./new-mail">
                            <i class="fa fa-envelope fa-3x fa-fw" aria-hidden="true"></i>
                            <h4>Розсилка</h4>
                          </a>                       
                        </div>
                        <div class="col-6 col-sm-4 text-center space-top">
                          <a  href="../">
                            <i class="fa fa-home fa-3x fa-fw" aria-hidden="true"></i>
                            <h4>На сайт</h4>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php require '../shared/footer.php'?>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
