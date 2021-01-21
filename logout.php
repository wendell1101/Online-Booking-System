<?php
    require_once('app/core.php');
    // if(!$_SESSION['user']){
    //     header('Location: login.php');
    // }
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: login.php');
    }

?>