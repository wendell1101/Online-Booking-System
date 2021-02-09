<?php
require "path.php";
require_once BASE . '/app/core.php';

$product = new Products();
$drinks = $product->getDrinks();


if (isset($_POST['reserve'])) {
    $reservation->reserve($_POST);
}

?>
<?php require_once BASE . '/app/includes/header.php' ?>


<div class="wrapper">
    <div class="menu-page">
        <nav class="menu-nav">
            <div class="container">
                <ul>
                    <li class="<?php echo (strpos(CURRENT_URL, 'menu') !== false) ? 'active' : '' ?>">
                        <a href="menu.php">Drinks</a>
                    </li>
                    <li class="<?php echo (strpos(CURRENT_URL, 'pastries') !== false) ? 'active' : '' ?>">
                        <a href="pastries.php">Pastries</a>
                    </li>
                    <li class="<?php echo (strpos(CURRENT_URL, 'desserts') !== false) ? 'active' : '' ?>">
                        <a href="desserts.php">Desserts</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-3 mb-5">
            <div class="row ">
                <?php if ($drinks) : ?>
                    <?php foreach ($drinks as $drink) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 p-2">
                            <div class="border p-1 product-img" style="min-height: 300px">
                                <div class="img-container">
                                    <img src="<?php echo  'assets/img/product_images/' . $drink->image ?>" class="img-fluid" alt="image" width="100%">
                                </div>
                                <p><?php echo $drink->name ?></p>
                                <p>PHP <?php echo $drink->price ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h2 class="text-secondary text-center">No drinks yet</h2>
                <?php endif; ?>


            </div>
        </div>
    </div>

</div>










<?php include 'app/includes/footer.php' ?>