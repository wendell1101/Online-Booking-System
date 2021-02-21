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
$reservations = $reservation->index('');

//sort by status
$status = '';
if (isset($_POST['status'])) {
    $status = sanitize($_POST['status']);
    $reservations = $reservation->index($status);
}
// search by transaction id
$q = '';

if (isset($_GET['q'])) {
    if (!empty($_GET['q'])) {
        $q = sanitize($_GET['q']);
        $reservations = $reservation->search($q);
    }
}
?>


<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Reservations</h4>
        </div>
        <div class="card-body">
            <div class="mb-2 d-flex">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" id="search-form">
                    <input type="text" name="q" id="q" placeholder="Search Transaction Id ..." value="<?php echo $q; ?>">
                    <button type="submit" name="search" id="search-btn" class="btn btn-sm btn-success search">
                        Search
                    </button>

                    <?php if ($q) : ?>
                        <h5 class="mt-4 mb-2">Search results for "<b><?php echo $q ?></b>"</h5>
                    <?php endif; ?>
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="ml-auto" id="sort-form">
                    <div class="form-group">
                        <label for="status">Sort status by:</label>
                        <select name="status" id="status">
                            <option value="all">All</option>
                            <option value="pending" <?php echo ($status == 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="reserved" <?php echo ($status == 'reserved') ? 'selected' : '' ?>>Reserved</option>
                            <option value="completed" <?php echo ($status == 'completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?php echo ($status == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>
                </form>

            </div>

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
                    <h2 class="text-secondary text-center">No Results Found</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    const sortForm = document.getElementById('sort-form');
    const status = document.getElementById('status');

    const searchForm = document.getElementById('search-form');
    const query = document.getElementById('q');
    const loader = document.getElementById('loader');
    const searchBtn = document.getElementById('search-btn');

    // sort
    status.addEventListener('change', (e) => {
        e.preventDefault();
        sortForm.submit();
    })

    // automatically search after 1.5secs
    query.addEventListener('keyup', () => {
        setTimeout(() => {
            searchBtn.innerHTML = `
            Searching ...
            <img src="../assets/img/loader.gif" id="loader" alt="" width="20">
            `;
            searchForm.submit();
        }, 1500);

    })
</script>
<?php require_once BASE . '/app/includes/admin/footer.php' ?>
<?php ob_flush() ?>