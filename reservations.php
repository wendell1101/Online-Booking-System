<?php
require "path.php";
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();

$reservation = new Reservation();

$reservations = $reservation->index();

?>
<?php require_once BASE . '/app/includes/header.php' ?>

<div class="wrapper">
    <div class="reservations" style="margin-top: 100px">
        <div class="container">
            <?php include 'app/includes/message.php' ?>
            <div class="card shadow">
                <div class="card-header d-flex align-items-center">
                    <h4>Reservations</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if ($reservations) : ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Transaction Id</th>
                                        <th scope="col">Reservation Date</th>
                                        <th scope="col">No. of People</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include BASE . '/app/includes/message.php' ?>

                                    <?php foreach ($reservations as $key => $activeReservation) : ?>
                                        <tr>
                                            <th scope="row"><?php echo $key + 1 ?></th>
                                            <td><a href="reservation_detail.php?id=<?php echo $activeReservation->id ?>&user_id=<?php echo $activeReservation->user_id ?>"><?php echo $activeReservation->transaction_id ?></a></td>
                                            <td><?php echo formatDate($activeReservation->date_time) ?></td>
                                            <td><?php echo $activeReservation->no_of_people ?></td>
                                            <td><?php echo $activeReservation->status ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        <?php else : ?>
                            <h2 class="text-secondary text-center">No Reservation Yet</h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'app/includes/footer.php' ?>