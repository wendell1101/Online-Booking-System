<?php
require "path.php";
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';

$reservation = new Reservation();
$errors = [];
$date_time = $no_of_people = $contact_number = "";

if (isset($_POST['reserve'])) {
    if (User::Auth()) {
        $reservation->reserve($_POST);
        $errors = $reservation->validate();
        $data = $reservation->getData();
        $date_time = sanitize($data['date_time']);
        $contact_number = sanitize($data['contact_number']);
        $no_of_people = sanitize($data['no_of_people']);
    } else {
        redirect('login.php');
    }
}

?>
<?php require_once BASE . '/app/includes/header.php' ?>
<div class="about-bg"></div>
<div class="wrapper">
    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col">
                </div>
                <div class=" col-md-5 col-sm-12">
                    <h2 class="text-title about-title text-center mb-5">About us</h2>
                    <p class="about-text">
                        Coffee Royale is a café built with passion to
                        share the best coffee experience in every cup.
                        <br> <br>
                        Every cup of coffee is carefully processed
                        to serve you the best quality brewed coffee,
                        from choosing the best beans we can source
                        each season directly from our farmers,
                        to roasting and grinding the beans
                        and brewing our coffee.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="about2">
        <div class="container">
            <div class="row">
                <div class="col-md-5 about2-left col-sm-12">
                    <h2 class="text-title about2-title mb-5">
                        We are not just about coffee
                    </h2>
                    <p class="about2-text">
                        To go with your great cup of coffee,
                        we also have freshly baked pastries
                        and sweet desserts prepared for you!
                    </p>
                </div>
                <div class="col-md-7 col-sm-12 about2-right">
                    <img src="assets/img/about_bread.png" alt="about image" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div class="about3 text-white d-flex justify-content-center flex-column align-items-center">
        <h1 class="text-title text-white mb-5">
            Visit Our Place
        </h1>
        <p class="text-center">
            Located at Paseo Uno De Calamba<br>
            Checkpoint, Brgy. Paciano<br>
            Calamba City, Laguna
        </p>
    </div>

    <div class="reservation">
        <div class="container">
            <h1 class="text-title">Reserve a Table</h1>
            <div class="row p-2">
                <div class="col-md-6 mx-auto border reservation-form p-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label for="date_time">Choose your desired date and time</label>
                            <input type="text" name="date_time" id="date_time" class="form-control
                            <?php
                            if (!empty($_POST['date_time'])) {
                                echo $errors['date_time'] ? 'is-invalid' : 'is-valid';
                            } else {
                                if ($errors['date_time']) {
                                    echo 'is-invalid';
                                }
                            }
                            ?>
                            " value="<?php echo $date_time ?>">
                            <div class="text-danger">
                                <small><?php echo $errors['date_time'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_of_people">Choose number of people</label>
                            <select name="no_of_people" id="no_of_people" class="form-control">
                                <option value="1" class="text-center">1 person</option>
                                <option value="2" class="text-center" selected>2 people</option>
                                <option value="3" class="text-center">3 people</option>
                                <option value="4" class="text-center">4 people</option>
                                <option value="5" class="text-center">5 people</option>
                            </select>
                            <div class="text-danger">
                                <small><?php echo $errors['no_of_people'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control
                            <?php
                            if (!empty($_POST['contact_number'])) {
                                echo $errors['contact_number'] ? 'is-invalid' : 'is-valid';
                            } else {
                                if ($errors['contact_number']) {
                                    echo 'is-invalid';
                                }
                            }
                            ?>
                            " value="<?php echo $contact_number ?>">
                            <div class="text-danger">
                                <small><?php echo $errors['contact_number'] ?? '' ?></small>
                            </div>
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