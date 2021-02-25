<?php
require "path.php";
require_once BASE . '/app/core.php';

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

<div class="wrapper">
    <!--Reservation -->
    <div class="reservation">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto border p-3">
                    <h2 class="text-center text-title mb-3">Reserve a Table</h2>
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