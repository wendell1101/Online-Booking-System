<?php
require "path.php";
require_once BASE . '/app/core.php';

$product = new Products();
$desserts = $product->getDesserts();
$activeProduct;

$id;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $activeProduct = $product->getProduct($id);
    $products = $product->getRandomSimilarProducts($activeProduct->category_id);
}

if (isset($_POST['reserve'])) {
    $reservation->reserve($_POST);
}

?>
<?php require_once BASE . '/app/includes/header.php' ?>


<div class="wrapper">
    <div class="menu-page">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h2><?php echo $activeProduct->name ?></h2>
                    <div class="img-container border p-4 text-center">
                        <img src="assets/img/product_images/<?php echo $activeProduct->image ?>" alt="product">
                    </div>
                    <small class="text-secondary mt-3"><?php echo $activeProduct->description ?></small>
                    <div class="d-flex justify-content-space-around mt-3">
                        <h4><?php echo showPrice($activeProduct->price) ?></h4>
                        <a href="reserve.php" class="btn btn-primary ml-auto">Reserve Now</a>
                    </div>
                </div>
            </div>
            <?php if ($products) : ?>
                <div class="row mt-5 mb-5">
                    <div class="col">
                        <p class="text-secondary">Similar products that you may like: </p>
                        <div class="row">
                            <?php foreach ($products as $product) : ?>
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <div class="img-container p-2 border text-center">
                                        <img src="assets/img/product_images/<?php echo $product->image ?>" width="150" alt="product">
                                        <p>
                                            <a href="product_detail.php?id=<?php echo $product->id ?>?category=menu?name=<?php echo strtolower($product->name) ?>">
                                                <?php echo $product->name ?>
                                            </a>
                                        </p>

                                    </div>
                                </div>

                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>










<?php include 'app/includes/footer.php' ?>