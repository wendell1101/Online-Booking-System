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
        <a href="index.php" class="logo">KingsGourmet</a>
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
                        <button type="submit" name="logout">Logout</button>
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
    </nav>