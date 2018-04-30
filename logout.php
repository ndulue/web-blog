<?php
    include 'db_connect.php';
    session_start();

    if ((!isset($_SESSION['admin']))) {
        header('location:admin.php');
    }

    unset($_SESSION['admin']);
    session_destroy();
    header('location:admin.php');
    

?>