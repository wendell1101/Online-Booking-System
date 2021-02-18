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
$reservations = $reservation->index();
?>


<div class="container">
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
                                <th scope="col">Actions</th>
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
                                    <td class="d-flex">
                                        <form action="admin_reservation_update.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $activeReservation->id ?>">
                                            <button type="submit" class="text-warning mr-3" style="border:none; background:none">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </form>
                                        <form action="admin_reservation_delete.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $activeReservation->id ?>">
                                            <button type="submit" style="border:none; background:none">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>

                                    </td>
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
<!-- /.content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once BASE . '/app/includes/admin/footer.php' ?>
<?php ob_flush() ?>