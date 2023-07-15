<?php 

    session_start();
    unset($_SESSION['db_login']);
    unset($_SESSION['admin_login']);
    header('location: index.php');

?>