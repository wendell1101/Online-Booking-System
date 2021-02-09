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
    <!--flatpckr -->
    <link rel="stylesheet" href="node_modules/flatpickr/dist/flatpickr.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
    <!--custom css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/sub-main.css">
    <link rel="stylesheet" href="assets/css/reservation.css">
</head>

<body>
    <nav class="main-nav">
        <?php if (strpos(CURRENT_URL, 'about')) : ?>
            <a href="index.php" class="logo"><img src="assets/img/logo2_light.png" alt="logo"></a>
        <?php else : ?>
            <a href="index.php" class="logo"><img src="assets/img/logo2_dark.png" alt="logo"></a>
        <?php endif; ?>
        <ul>
            <li class="<?php echo (strpos(CURRENT_URL, 'index') !== false) ? 'active-home' : '' ?>">
                <a href=" index.php">Home</a>
            </li>
            <li class="<?php echo (strpos(CURRENT_URL, 'about') !== false) ? 'active' : '' ?>">
                <a href="about.php">About</a>
            </li>
            <li class="
                <?php if (strpos(CURRENT_URL, 'menu') !== false) : ?>
                    active
                <?php elseif (strpos(CURRENT_URL, 'pastries') !== false) : ?>
                    active
                <?php elseif (strpos(CURRENT_URL, 'desserts') !== false) : ?>
                    active
                <?php endif ?>
                ">
                <a href="menu.php">Menu</a>
            </li>
            <li class="<?php echo (strpos(CURRENT_URL, 'contact') !== false) ? 'active' : '' ?>">
                <a href="contact.php">Contact</a>
            </li>
            <li class="<?php echo (strpos(CURRENT_URL, 'reservation') !== false) ? 'active' : '' ?>">
                <a href="reservations.php">Reservations</a>
            </li>
            <?php if (User::Auth()) : ?>
                <?php if ($user->isAdmin()) : ?>
                    <li>
                        <a href="admin/dashboard.php">Admin</a>
                    </li>
                <?php endif; ?>
                <li>
                    <form action="logout.php" method="POST">
                        <button type="submit" class="" name="logout" style="border:none; background:none; width:100%">Logout</button>
                    </form>
                </li>
            <?php else : ?>
                <li>
                    <a href="login.php">Login</a>
                </li>
                <li>
                    <a href="register.php">Register</a>
                </li>
            <?php endif ?>
        </ul>
        <?php if (strpos(CURRENT_URL, 'about') !== false) : ?>
            <span class="hamburger about-hamburger"><i class="fas fa-bars"></i></span>
        <?php else : ?>
            <span class="hamburger" style="color: black!important"><i class="fas fa-bars"></i></span>
        <?php endif; ?>
    </nav>
    <ul class="side-nav">

        <a href="index.php" class="side-nav-logo"><img src="assets/img/logo2_light.png" alt="logo"></a>
        <li class="<?php echo (strpos(CURRENT_URL, 'index') !== false) ? 'active' : '' ?>">
            <a href="index.php">Home</a>
        </li>
        <li class="<?php echo (strpos(CURRENT_URL, 'about') !== false) ? 'active' : '' ?>">
            <a href="about.php">About</a>
        </li>
        <li class="
                <?php if (strpos(CURRENT_URL, 'menu') !== false) : ?>
                    active
                <?php elseif (strpos(CURRENT_URL, 'pastries') !== false) : ?>
                    active
                <?php elseif (strpos(CURRENT_URL, 'desserts') !== false) : ?>
                    active
                <?php endif ?>
            ">
            <a href="menu.php">Menu</a>
        </li>
        <li class="<?php echo (strpos(CURRENT_URL, 'contact') !== false) ? 'active' : '' ?>">
            <a href="contact.php">Contact</a>
        </li>
        <li class="<?php echo (strpos(CURRENT_URL, 'reservation') !== false) ? 'active' : '' ?>">
            <a href="reservations.php">Reservations</a>
        </li>
        <?php if (User::Auth()) : ?>
            <?php if ($user->isAdmin()) : ?>
                <li>
                    <a href="admin/dashboard.php">Admin</a>
                </li>
            <?php endif; ?>
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
        <?php endif ?>
    </ul>