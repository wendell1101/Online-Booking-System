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
$categories = $product->getCategories();
$errors = [];

$name = $image = $price = $description = $category_id = '';

if (isset($_POST['id'])) {
    $id = sanitize($_POST['id']);
    $activeProduct = $product->getProduct($id);
    $name = $activeProduct->name;
    $price = $activeProduct->price;
    $image = $activeProduct->image;
    $description = $activeProduct->description;
    $category_id = $activeProduct->category_id;
    $id = $activeProduct->id;
} else {
    redirect('products.php');
}
if (isset($_POST['update'])) {
    $product->update($_POST);
    $errors = $product->validate();
}

?>

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Update Product</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $activeProduct->id ?>">
                <div class="form-group">
                    <div class="text-center">
                        <img src="<?php echo  '../assets/img/product_images/' . $image ?>" alt="image" width="200"><br>
                    </div>

                    <label for="name">Image</label>
                    <input type="file" name="image" id="image" class="form-control
                    <?php
                    if (!empty($_POST['image'])) {
                        echo $errors['image'] ? 'is-invalid' : '';
                    } else {
                        if ($errors['image']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    " value="<?php echo $_POST['image'] ?? '' ?>">
                    <div class="text-danger">
                        <small><?php echo $errors['image'] ?? '' ?></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control
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
                </div>
                <div class="form-group">
                    <label for="name">Price</label>
                    <input type="text" name="price" id="price" class="form-control
                    <?php
                    if (!empty(($name))) {
                        echo $errors['price'] ? 'is-invalid' : '';
                    } else {
                        if ($errors['price']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    " value="<?php echo number_format((float)$price, 2, '.', '') ?>">
                    <div class="text-danger">
                        <small><?php echo $errors['price'] ?? '' ?></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control
                    <?php
                    if (!empty($description)) {
                        echo $errors['description'] ? 'is-invalid' : '';
                    } else {
                        if ($errors['description']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    ">
                    <?php echo $description ?>
                    </textarea>
                    <div class="text-danger">
                        <small><?php echo $errors['description'] ?? '' ?></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Category">Category</label>
                    <select name="category_id" id="category_id" class="form-control
                    <?php
                    if (!empty($category_id)) {
                        echo $errors['category_id'] ? 'is-invalid' : '';
                    } else {
                        if ($errors['category_id']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    ">
                        <option value="null">Please choose a category</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category->id ?>" <?php echo ($category_id == $category->id) ? "selected" : '' ?>>
                                <?php echo $category->name ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger">
                        <small><?php echo $errors['category_id'] ?? '' ?></small>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-end align-items-center mt-2">
                    <a href="products.php" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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