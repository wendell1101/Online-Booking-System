<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();
require_once BASE . '/app/middlewares/CheckIfAdminOrProductManager.php';

$reservation = new AdminReservation();
$activeReservation;
$user = '';
if (isset($_GET['user_id'])) {
    $user = $reservation->getUser($_GET['user_id']);
}
if (isset($_GET['id'])) {
    $activeReservation = $reservation->getReservation($_GET['id']);
}
?>


<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Reserved by</h4><br>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($user) : ?>
                    <table class="table">
                        <a href="reservations.php">
                            <i class="fas fa-long-arrow-alt-left" style="font-size: 2rem; color: #3f240d"></i>
                        </a>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">No. of People</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include BASE . '/app/includes/message.php' ?>

                            <tr>
                                <th scope="row"><?php echo 1 ?></th>
                                <td><?php echo $user->firstname . ' ' . $user->lastname ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $activeReservation->no_of_people ?></td>
                                <td><?php echo $activeReservation->contact_number ?></td>
                                <td><?php echo $activeReservation->status ?></td>
                                <td><?php echo shortDate($activeReservation->created_at) ?></td>

                            </tr>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h2 class="text-secondary text-center">No Reservation Yet</h2>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once BASE . '/app/includes/admin/footer.php' ?>
<?php ob_flush() ?>