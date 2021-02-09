<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
require_once BASE . '/app/middlewares/CheckIfIsAdmin.php';

$reservation = new AdminReservation();

$id = '';
if (isset($_POST['id'])) {
    $id = sanitize($_POST['id']);
    $activeReservation = $reservation->getReservation($id);
    $id = $activeReservation->id;
} else {
    redirect('reservations.php');
}
if (isset($_POST['update'])) {
    $reservation->update($_POST);
}

?>

<!-- Main content -->

<!-- Main content -->

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Update Reservation</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label for="date_time">Date and Time</label>
                    <input type="text" name="date_time" id="date_time" class="form-control" value="<?php echo $activeReservation->date_time ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="no_of_people">Choose number of people</label>
                    <input type="text" name="no_of_people" id="no_of_people" class="form-control" readonly value="<?php echo $activeReservation->no_of_people ?>">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" class="text-center" <?php echo ($activeReservation->no_of_people === 1) ? "selected" : '' ?>>Pending</option>
                        <option value="reserved" <?php echo ($activeReservation->status === 'reserved') ? "selected" : '' ?> class="text-center">Reserved</option>
                        <option value="completed" <?php echo ($activeReservation->status === 'completed') ? "selected" : '' ?> class="text-center">Completed</option>
                        <option value="cancelled" <?php echo ($activeReservation->status === 'cancelled') ? "selected" : '' ?> class="text-center">Cancelled</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $activeReservation->id ?>">
                <div class="form-group">
                    <button type="submit" name="update" class="btn float-right">Reserve</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once BASE . '/app/includes/admin/footer.php';
ob_flush();
?>