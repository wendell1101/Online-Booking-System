<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/CheckIfAdminOrProductManager.php';

$dashboard = new Dashboard();
?>

<!-- Main content -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <?php include BASE . '/app/includes/message.php' ?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $dashboard->getUsersCount(); ?></h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="admin_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $dashboard->getCategoriesCount(); ?></h3>
                        <p>Catagories</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <a href="categories.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $dashboard->getProductsCount(); ?></h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class=" fas fa-coffee mr-2"></i>
                    </div>
                    <a href="products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3><?php echo $dashboard->getReservationsCount(); ?></h3>

                        <p>Reservations</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    <a href="reservations.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6 mt-5">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
<!-- /.content-wrapper -->


<?php include '../app/includes/admin/footer.php' ?>
<?php ob_flush() ?>