<?php
    require_once('database/Database.php');
    require('config/Config.php');
    require_once('controllers/UserController.php');
    require_once('controllers/Sanitize.php');
    require_once('models/User.php');

    // middlewares



    // start session
    session_start();

    // instantiate user model
    $user = new User();
    // instantiate middlewares







