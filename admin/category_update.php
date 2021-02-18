<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();
require_once BASE . '/app/middlewares/CheckIfAdminOrProductManager.php';

$category = new Category();
$errors = [];

$name = '';
$id = '';
if (isset($_POST['id'])) {
    $id = sanitize($_POST['id']);
    $activeCategory = $category->getCategory($id);
    $name = $activeCategory->name;
    $id = $activeCategory->id;
}
if (isset($_POST['update'])) {
    $category->update($_POST);
    $errors = $category->validate();
}

?>

<!-- Main content -->

<!-- Main content -->

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Update Category</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $name ?>" class="form-control
                    <?php
                    if (!empty(($name))) {
                        echo $errors['name'] ? 'is-invalid' : '';
                    } else {
                        if ($errors['name']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    " value="<?php echo $name ?>">
                    <div class="text-danger">
                        <small><?php echo $errors['name'] ?? '' ?></small>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group d-flex justify-content-end align-items-center mt-2">
                        <a href="categories.php" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
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

<?php require_once BASE . '/app/includes/admin/footer.php';
ob_flush();
?>