<?php

include('path.php');
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();
$reserve = new Reservation();

$reservation = [];
if (isset($_GET['user_id'])) {
    $activeUser = $reserve->getUser($_GET['user_id']);
} else {
    redirect('index.php');
}
if (isset($_GET['id'])) {
    $reservation = $reserve->getReservation($_GET['id']);
} else {
    redirect('index.php');
}

?>
<?php require_once 'app/includes/header.php' ?>

<div class="wrapper">
    <div class="container" style="margin-top:100px; margin-bottom:100px">
        <?php include 'app/includes/message.php' ?>
        <article class="card border">
            <div class="card-body">
                <h6>Transaction Id: <?php echo $reservation->transaction_id ?></h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Reserved By:</strong> <br><?php echo $activeUser->firstname . ' ' . $activeUser->lastname ?></div>
                        <div class="col"> <strong>Email:</strong> <br><?php echo $activeUser->email ?></div>
                        <div class="col text-uppercase"> <strong>Status:</strong> <br> <?php echo $reservation->status ?> </div>
                        <div class="col"> <strong>Transaction Id #:</strong> <br> <?php echo $reservation->transaction_id ?></div>
                    </div>
                </article>
                <div class="track">
                    <?php if ($reservation->status === 'pending') : ?>
                        <div class="step active"> <span class="icon"> <i class="far fa-clock"></i> </span> <span class="text">Pending</span> </div>
                        <div class="step"> <span class="icon"><i class="far fa-calendar-check"></i> </span> <span class="text"> Reserved</span> </div>
                        <div class="step"> <span class="icon"> <i class="fas fa-check"></i> </span> <span class="text"> Completed</span> </div>
                        <div class="step"> <span class="icon"> <i class="far fa-window-close"></i> </span> <span class="text">Cancelled</span> </div>
                    <?php elseif ($reservation->status === 'reserved') : ?>
                        <div class="step active"> <span class="icon"> <i class="far fa-clock"></i> </span> <span class="text">Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="far fa-calendar-check"></i> </span> <span class="text"> Reserved</span> </div>
                        <div class="step"> <span class="icon"> <i class="fas fa-check"></i> </span> <span class="text"> Completed</span> </div>
                        <div class="step"> <span class="icon"> <i class="far fa-window-close"></i> </span> <span class="text">Cancelled</span> </div>
                    <?php elseif ($reservation->status === 'completed') : ?>
                        <div class="step active"> <span class="icon"> <i class="far fa-clock"></i> </span> <span class="text">Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="far fa-calendar-check"></i> </span> <span class="text"> Reserved</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fas fa-check"></i> </span> <span class="text"> Completed</span> </div>
                        <div class="step"> <span class="icon"> <i class="far fa-window-close"></i> </span> <span class="text">Cancelled</span> </div>
                    <?php elseif ($reservation->status === 'cancelled') : ?>
                        <div class="step active"> <span class="icon"> <i class="far fa-clock"></i> </span> <span class="text">Order created</span> </div>
                        <div class="step active"> <span class="icon"> <i class="far fa-calendar-check"></i> </span> <span class="text"> Paid</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fas fa-check"></i> </span> <span class="text"> Shipped</span> </div>
                        <div class="step active"> <span class="icon"> <i class="far fa-window-close"></i> </span> <span class="text">Refunded</span> </div>
                    <?php endif; ?>
                </div>
                <hr>


                <span>Date and Time: <?php echo formatDate($reservation->date_time) ?></span><br>
                <span>Number of People: <?php echo $reservation->no_of_people ?></span><br>
                <span>Contact Number: <?php echo $reservation->contact_number ?></span>

                <hr>
                <a href="reservations.php" class="btn btn-primary" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to reservations</a>
            </div>
        </article>
    </div>
</div>
<?php include 'app/includes/footer.php' ?>