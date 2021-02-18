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
if (isset($_GET['slug'])) {
    $activeCategory = $category->getCategory($_GET['slug']);
    $products = $category->getProductInCategory($activeCategory->id);
} else {
    redirect('categories.php');
}


?>


<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Category: <?php echo $activeCategory->name ?></h4><br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="categories.php">
                    <i class="fas fa-long-arrow-alt-left" style="font-size: 2rem; color: #3f240d"></i>
                </a>
                <?php if ($products) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include BASE . '/app/includes/message.php' ?>

                            <?php foreach ($products as $key => $product) : ?>
                                <tr>
                                    <th scope="row"><?php echo $key + 1 ?></th>
                                    <td>
                                        <img src="<?php echo  '../assets/img/product_images/' . $product->image ?>" alt="image" width="50" height="50">
                                    </td>
                                    <td><?php echo $product->name ?></td>
                                    <td>PHP <?php echo showPrice($product->price) ?></td>

                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php else : ?>
                    <h2 class="text-secondary text-center">No Product Yet</h2>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once BASE . '/app/includes/admin/footer.php' ?>
<?php ob_flush() ?>