<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();
require_once BASE . '/app/middlewares/CheckIfAdminOrProductManager.php';

$product = new Product();
$products = $product->index('');
$categories = $product->getCategories();


//sort by status
$category_id = '';
if (isset($_POST['category_id'])) {
    $category_id = sanitize($_POST['category_id']);
    $products = $product->index($category_id);
}
// search by transaction id
$q = '';

if (isset($_GET['q'])) {
    if (!empty($_GET['q'])) {
        $q = sanitize($_GET['q']);
        $products = $product->search($q);
    }
}
?>


<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Products</h4>
            <a href="product_create.php" class="btn btn-primary ml-auto"><i class="fas fa-plus text-light"></i></a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-2 d-flex">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" id="search-form">
                        <input type="text" name="q" id="q" placeholder="Search Product Name ..." value="<?php echo $q; ?>">
                        <button type="submit" name="search" id="search-btn" class="btn btn-sm btn-success search">
                            Search
                        </button>

                        <?php if ($q) : ?>
                            <h5 class="mt-4 mb-2">Search results for "<b><?php echo $q ?></b>"</h5>
                        <?php endif; ?>
                    </form>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="ml-auto" id="sort-form">
                        <div class="form-group">
                            <label for="status">Sort products by:</label>
                            <select name="category_id" id="status">
                                <option value="all">All</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id ?>" <?php echo ($category_id == $category->id) ? 'selected' : '' ?>><?php echo $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>

                </div>
                <?php if ($products) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
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
                                    <td><?php echo showPrice($product->price) ?></td>

                                    <td class="d-flex">

                                        <form action="product_update.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $product->id ?>">
                                            <button type="submit" class="text-warning mr-3" style="border:none; background:none">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </form>
                                        <form action="product_delete.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $product->id ?>">
                                            <button type="submit" style="border:none; background:none">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>

                                    </td>
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

<script>
    const sortForm = document.getElementById('sort-form');
    const status = document.getElementById('status');

    const searchForm = document.getElementById('search-form');
    const query = document.getElementById('q');
    const loader = document.getElementById('loader');
    const searchBtn = document.getElementById('search-btn');

    // sort
    status.addEventListener('change', (e) => {
        e.preventDefault();
        sortForm.submit();
    })

    // automatically search after 1.5secs
    query.addEventListener('keyup', () => {
        setTimeout(() => {
            searchBtn.innerHTML = `
            Searching ...
            <img src="../assets/img/loader.gif" id="loader" alt="" width="20">
            `;
            searchForm.submit();
        }, 1500);

    })
</script>

<?php require_once BASE . '/app/includes/admin/footer.php' ?>
<?php echo ob_flush() ?>