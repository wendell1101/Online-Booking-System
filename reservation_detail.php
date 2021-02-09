<?php

include('path.php');
require_once BASE . '/app/core.php';
$reserve = new Reservation();

$reservation = [];
if (isset($_SESSION['reservation'])) {
    $reservation = $_SESSION['reservation'];
    $user = $reserve->getUser($reservation->user_id);
} else {
    redirect('index.php');
}

echo "<h1>Reservation detail</h1>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/reservation.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="margin-top:100px; margin-bottom:100px">
        <article class="card shadow">
            <div class="card-body">
                <h6>Transaction Id: AABHSJDHS</h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Reserved By:</strong> <br><?php echo $user->firstname . ' ' . $user->lastname ?></div>
                        <div class="col"> <strong>Email:</strong> <br><?php echo $user->email ?><i class="fa fa-phone"></i> +63998234823 </div>
                        <div class="col text-uppercase"> <strong>Status:</strong> <br> <?php echo $reservation->status ?> </div>
                        <div class="col"> <strong>Transaction Id #:</strong> <br> ABSDSAJDAK</div>
                    </div>
                </article>
                <div class="track">
                    <?php if ($reservation->status === 'pending') : ?>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
                        <div class="step"> <span class="icon"><i class="far fa-calendar-check"></i> </span> <span class="text"> Reserved</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Completed</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-undo"></i> </span> <span class="text">Cancelled</span> </div>
                    <?php elseif ($order->status === 'reserved') : ?>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-credit-card"></i> </span> <span class="text"> Reserved</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Completed</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-undo"></i> </span> <span class="text">Cancelled</span> </div>
                    <?php elseif ($order->status === 'completed') : ?>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-credit-card"></i> </span> <span class="text"> Reserved</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Completed</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-undo"></i> </span> <span class="text">Cancelled</span> </div>
                    <?php elseif ($order->status === 'cancelled') : ?>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order created</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-credit-card"></i> </span> <span class="text"> Paid</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Shipped</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-undo"></i> </span> <span class="text">Refunded</span> </div>
                    <?php endif; ?>
                </div>
                <hr>


                <span>Date and Time: <?php echo $reservation->date_time ?></span><br>
                <span>Number of People: <?php echo $reservation->no_of_people ?></span>

                <hr>
                <a href="#" class="btn" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to reservations</a>
            </div>
        </article>
    </div>
</body>

</html>