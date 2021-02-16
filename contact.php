<?php
require "path.php";
require_once BASE . '/app/core.php';

$reservation = new Reservation();

if (isset($_POST['reserve'])) {
    $reservation->reserve($_POST);
}

?>
<?php require_once BASE . '/app/includes/header.php' ?>

<div class="wrapper">
    <div class="contact" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-title text-center" data-aos="fade-down">Contact Us</h2>
                    <h5 class="text-center mt-4">We love hearing from our customers. </h5>
                </div>
                <div class="col-md-5">
                    <div class="row contact-texts">
                        <div class="col-md-12 mt-5">
                            <h4>Email</h4>
                            <p class="text-title pb-2">coffeeroyale@gmail.com</p>
                        </div>
                        <div class="col-md-12 mt-5">
                            <h4>Call</h4>
                            <p class="text-title pb-2">2342-3244-4232</p>
                        </div>
                        <div class="col-md-12 mt-5">
                            <h4>Address</h4>
                            <p class="text-title pb-2">
                                Paseo Uno De Calamba <br>
                                Checkpoint, Brgy. Paciano <br>
                                Calamba City, Laguna <br>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 mt-5">
                    <img src="assets/img/place1.jpg" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'app/includes/footer.php' ?>