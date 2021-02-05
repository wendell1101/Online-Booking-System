<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/CheckIfIsAdmin.php';

$product = new Product();
$categories = $product->getCategories();
$errors = [];

$name = $image = $price = $description = $category_id = '';
if (isset($_POST['create'])) {
    $product->create($_POST);
    $errors = $product->validate();
    $data = $product->getData();
    // $image = $data['image'];
    $name = $data['name'];
    $price = $data['price'];
    $description = $data['description'];
    $category_id = $data['category_id'];
}


?>

<!-- Main content -->

<!-- Main content -->

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Create Product</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Image</label>
                    <input type="file" name="image" id="image" class="form-control
                    <?php
                    if (!empty($_POST['image'])) {
                        echo $errors['image'] ? 'is-invalid' : 'is-valid';
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
                        echo $errors['name'] ? 'is-invalid' : 'is-valid';
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
                        echo $errors['price'] ? 'is-invalid' : 'is-valid';
                    } else {
                        if ($errors['price']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    " value="<?php echo $price ?>">
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
                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger">
                        <small><?php echo $errors['category_id'] ?? '' ?></small>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-end align-items-center mt-2">
                    <a href="categories.php" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" name="create" class="btn btn-primary">Create</button>
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