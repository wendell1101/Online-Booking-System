<?php
require "path.php";
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();

$reservation = new Reservation();

if (isset($_POST['reserve'])) {
    $reservation->reserve($_POST);
}

?>
<?php require_once BASE . '/app/includes/main-header.php' ?>
<div class="hero-wrapper"></div>
<div class="wrapper">
    <div class="container">
        <?php include BASE . '/app/includes/message.php' ?>
        <div class="row hero">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 hero-right">
                <h1 class="super-text">The Home of Freshly Brewed Coffee</h1>
            </div>
        </div>
    </div>

</div>

<div class="wrapper">
    <!--Our place -->
    <div class="place">
        <div class="container">
            <h1 class="text-center text-title place-title">Our Place</h1>
            <div class="place-container">
                <div class="row">
                    <div class="col-md-8">
                        <img src="assets/img/place1.jpg" alt="place image" class="place-image mb-2">
                        <a href="" class="btn place-btn float-right mb-2">View More</a>
                    </div>
                    <div class="col-md-4 pl-2 ">
                        <img src="assets/img/place2.jpg" alt="place image" class="place-image mb-2">
                        <img src="assets/img/place3.jpg" alt="place image" class="place-image mb-2">
                        <a href="" class="btn place-btn2 float-right mb-2" style="display:none">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Our Categorize Menu -->
    <div class="menu">
        <div class="container">
            <h1 class="text-title">Our Categorized Menu</h1>
            <div class="row justify-content-center mt-5 p-2">
                <a href="menu.php" class="col-md-3 mr-4 mb-2 text-center bg-white menu-category">
                    <i class="fas fa-mug-hot"></i>
                    <span class="category-text">
                        Drinks
                    </span>
                </a>
                <a href="pastries.php" class="col-md-3 mr-4 mb-2 text-center bg-white menu-category">
                    <i class="fas fa-bread-slice"></i>
                    <span class="category-text">
                        Pastries
                    </span>
                </a>
                <a href="desserts.php" class="col-md-3 mr-4 mb-2 text-center bg-white menu-category">
                    <i class="fas fa-ice-cream"></i>
                    <span class="category-text">
                        Deserts
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!--Reservation -->
    <div class="reservation">
        <div class="container">
            <h1 class="text-title">Reserve a Table</h1>
            <div class="row p-2">
                <div class="col-md-6 mx-auto border reservation-form p-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label for="date_time">Choose your desired date and time</label>
                            <input type="text" name="date_time" id="date_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_of_people">Choose number of people</label>
                            <select name="no_of_people" id="no_of_people" class="form-control">
                                <option value="1" class="text-center">1 person</option>
                                <option value="2" class="text-center">2 people</option>
                                <option value="3" class="text-center">3 people</option>
                                <option value="4" class="text-center">4 people</option>
                                <option value="5" class="text-center">5 people</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="reserve" class="btn float-right">Reserve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include 'app/includes/footer.php' ?>