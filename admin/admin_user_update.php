<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
require_once BASE . '/app/middlewares/CheckIfIsAdmin.php';

$adminUser = new AdminUser();
$errors = [];

$firstname = $lastname = $email = '';
$id = '';
if (isset($_POST['id'])) {
    $id = sanitize($_POST['id']);
    $activeUser = $adminUser->getUser($id);
    $firstname = $activeUser->firstname;
    $lastname = $activeUser->lastname;
    $email = $activeUser->email;
    $id = $activeUser->id;
} else {
    redirect('admin_users.php');
}
if (isset($_POST['update'])) {
    $adminUser->update($_POST);
    $errors = $adminUser->validate();
}

?>

<!-- Main content -->

<!-- Main content -->

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Update User</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="row">
                    <!--firstname-->
                    <div class="col-6">
                        <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name*" class="form-control
                            <?php
                            if (!empty(($firstname))) {
                                echo $errors['firstname'] ? 'is-invalid' : '';
                            } else {
                                if ($errors['firstname']) {
                                    echo 'is-invalid';
                                }
                            }
                            ?>
                        " value="<?php echo $firstname ?>" readonly>
                        <div class="text-danger">
                            <small><?php echo $errors['firstname'] ?? '' ?></small>
                        </div>
                    </div>
                    <!--lastname-->
                    <div class="col-6">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" id="lastname" class="form-control
                            <?php
                            if (!empty(($lastname))) {
                                echo $errors['lastname'] ? 'is-invalid' : '';
                            } else {
                                if ($errors['lastname']) {
                                    echo 'is-invalid';
                                }
                            }
                            ?>
                        " placeholder="Last Name*" value="<?php echo $lastname ?>" readonly>
                        <div class="text-danger">
                            <small><?php echo $errors['lastname'] ?? '' ?></small>
                        </div>
                    </div>
                </div>
                <!--email-->
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control
                        <?php
                        if (!empty(($email))) {
                            echo $errors['email'] ? 'is-invalid' : '';
                        } else {
                            if ($errors['email']) {
                                echo 'is-invalid';
                            }
                        }
                        ?>
                    " placeholder="Enter email*" value="<?php echo $email ?>" readonly>
                    <div class="text-danger">
                        <small><?php echo $errors['email'] ?? '' ?></small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="is_admin" <?php echo ($activeUser->is_admin === 1) ? "selected" : '' ?>>Admin</option>
                        <option value="is_product_manager" <?php echo ($activeUser->is_product_manager === 1) ? "selected" : '' ?>>Product Manager</option>
                        <option value="customer" <?php echo ($activeUser->is_admin === 0 && $activeUser->is_product_manager === 0) ? "selected" : '' ?>>Customer</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group d-flex justify-content-end align-items-center mt-2">
                    <a href="admin_users.php" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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