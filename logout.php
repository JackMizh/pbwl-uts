<?php
    session_start();
    include 'config.php';  
    $data = new Databases; 
    $data->logout();
?>