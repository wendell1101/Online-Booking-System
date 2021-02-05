<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
require_once BASE . '/app/middlewares/CheckIfIsAdmin.php';

$product = new Product();


if (isset($_POST['id'])) {
    $id = sanitize($_POST['id']);
    $activeProduct = $product->getProduct($id);
}
if (isset($_POST['delete'])) {
    $product->delete($_POST['id']);
}




?>

<!-- Main content -->

<!-- Main content -->

<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <h1>Are you sure you want to delete <?php echo $activeProduct->name ?>?</h1>
                    <div class="form-group d-flex justify-content-end align-items-center mt-2">
                        <input type="hidden" name="id" value="<?php echo $activeProduct->id ?>">
                        <a href="products.php" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once BASE . '/app/includes/admin/footer.php' ?>
<?php ob_flush(); ?>