<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/CheckIfAdminOrProductManager.php';

$dashboard = new Dashboard();
?>

<!-- Main content -->

<?php include '../app/includes/admin/dashboard-content.php' ?>

<!-- /.content -->
<!-- /.content-wrapper -->

<?php include '../app/includes/admin/footer.php' ?>
<?php ob_flush() ?>