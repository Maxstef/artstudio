<?php
    
session_start();

function connect_to_db(){
    global $db_config;
    return new mysqli($db_config->servername, $db_config->username, $db_config->password, $db_config->db);
}

function is_loged_in() {
    return isset($_SESSION['email']);
}