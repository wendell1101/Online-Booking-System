<?php
include "path.php";
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();

$auth->restrict();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE ?></title>
    <!--fontawesome5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--custom css -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <nav class="main-nav">
        <a href="index.php" class="logo"><img src="assets/img/logo2_light.png" alt="logo"></a>
        <ul>
            <?php if (User::Auth()) : ?>

                <li>
                    <a href="#"><?php echo $user->getFullName(); ?></a>
                </li>
                <li>
                    <a href="#">Menu</a>
                </li>
                <li>
                    <a href="#">Reserve Now</a>
                </li>
                <li>
                    <form action="logout.php" method="POST">
                        <button type="submit" class="text-white" name="logout" style="border:none; background:none; width:100%">Logout</button>
                    </form>
                </li>
            <?php else : ?>
                <li>
                    <a href="login.php">Login</a>
                </li>
                <li>
                    <a href="register.php">Register</a>
                </li>
            <?php endif; ?>

        </ul>

        <span class="hamburger"><i class="fas fa-bars"></i></span>
    </nav>
    <ul class="side-nav">
        <?php if (User::Auth()) : ?>

            <li class="active">
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Menu</a>
            </li>
            <li>
                <a href="#">Reserve Now</a>
            </li>
            <li>
                <form action="logout.php" method="POST">
                    <button type="submit" class="text-white" name="logout" style="border:none; background:none; width:100%">Logout</button>
                </form>
            </li>
        <?php else : ?>
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="register.php">Register</a>
            </li>
        <?php endif; ?>
    </ul>

    <?php include 'app/includes/message.php' ?>
    <div class="wrapper">
        <div class="container">
            <div class="row hero">
                <div class="col-md-6">

                </div>
                <div class="col-md-6 hero-right">
                    <h1 class="super-text">The Home of Freshly Brewed Coffee</h1>
                </div>
            </div>
        </div>
    </div>


    <?php include 'app/includes/footer.php' ?>