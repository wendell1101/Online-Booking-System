<?php
    require_once('app/core.php');
    // if(!$_SESSION['user']){
    //     header('Location: login.php');
    // }
    if(isset($_POST['logout'])){
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['token']);
        unset($_SESSION['active']);
        header('Location: login.php');
    }

?>