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
    <link rel="stylesheet" href="assets/css/about.css">
</head>

<body>
    <nav class="main-nav">
        <a href="index.php" class="logo"><img src="assets/img/logo2_light.png" alt="logo"></a>
        <ul>

            <li class="active-home">
                <a href="#">Home</a>
            </li>
            <li>
                <a href="about.php">About</a>
            </li>
            <li>
                <a href="menu.php">Menu</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
            <li>
                <form action="logout.php" method="POST">
                    <button type="submit" class="text-white" name="logout" style="border:none; background:none; width:100%">Logout</button>
                </form>
            </li>
        </ul>

        <span class="hamburger"><i class="fas fa-bars"></i></span>
    </nav>
    <ul class="side-nav">

        <a href="index.php" class="side-nav-logo"><img src="assets/img/logo2_light.png" alt="logo"></a>
        <li class="active">
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="about.php">About</a>
        </li>
        <li>
            <a href="menu.php">Menu</a>
        </li>
        <li>
            <a href="contact.php">Contact</a>
        </li>
        <li>
            <form action="logout.php" method="POST">
                <button type="submit" class="text-white" name="logout" style="border:none; background:none; width:100%">Logout</button>
            </form>
        </li>
    </ul>