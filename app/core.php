<?php
require_once('database/Database.php');
require('config/Config.php');
require_once('controllers/UserController.php');
require_once('controllers/admin/CategoryController.php');
require_once('controllers/admin/ProductController.php');
require_once('models/User.php');
require_once('helpers/kernel.php');




// start session
session_start();

// instantiate user model
$user = new User();
    // instantiate middlewares
