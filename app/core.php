<?php
    require_once('database/Database.php');
    require('config/Config.php');
    require_once('controllers/UserController.php');
    require_once('controllers/Sanitize.php');
    require_once('models/User.php');

    // start session
    session_start();

    // declare a constant for active user
    $user = new User();





