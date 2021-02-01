<?php
    require_once('database/Database.php');
    require('config/Config.php');
    require_once('controllers/UserController.php');
    require_once('models/User.php');
    require_once('helpers/kernel.php');

    // middlewares



    // start session
    session_start();

    // instantiate user model
    $user = new User();
    // instantiate middlewares







