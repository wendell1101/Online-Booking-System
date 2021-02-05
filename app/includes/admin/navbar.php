<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav" style="width:100%;">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../index.php" class="nav-link">View ClientSide</a>
        </li>


        <li class="nav-item dropdown" style="margin-left:auto">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Wendell Suazo
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <form action="<?php echo BASE . '/logout.php' ?>" method="POST">
                    <button type="submit" name="logout" style="border:none; background:none; width:100%">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>