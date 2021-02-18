<?php
ob_start();
require_once '../path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/includes/admin/header.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();
$auth->restrict();
require_once BASE . '/app/middlewares/CheckIfAdminOrProductManager.php';

$adminUser = new AdminUser();

$errors = [];
$firstname = $lastname = $email = $password1 = $password2 = '';
if (isset($_POST['create'])) {
    $adminUser->create($_POST);
    $errors = $adminUser->validate();
    //get the data
    $data = $adminUser->getData();
    $firstname = sanitize($data['firstname']);
    $lastname = sanitize($data['lastname']);
    $email = sanitize($data['email']);
    $password1 = sanitize($data['password1']);
    $password2 = sanitize($data['password2']);
}


?>

<!-- Main content -->

<!-- Main content -->

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h4>Create User</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="row">
                    <!--firstname-->
                    <div class="col-6">
                        <input type="text" name="firstname" id="firstname" placeholder="First Name*" class="form-control
                            <?php
                            if (!empty(($firstname))) {
                                echo $errors['firstname'] ? 'is-invalid' : 'is-valid';
                            } else {
                                if ($errors['firstname']) {
                                    echo 'is-invalid';
                                }
                            }
                            ?>
                        " value="<?php echo $firstname ?>">
                        <div class="text-danger">
                            <small><?php echo $errors['firstname'] ?? '' ?></small>
                        </div>
                    </div>
                    <!--lastname-->
                    <div class="col-6">
                        <input type="text" name="lastname" id="lastname" class="form-control
                            <?php
                            if (!empty(($lastname))) {
                                echo $errors['lastname'] ? 'is-invalid' : 'is-valid';
                            } else {
                                if ($errors['lastname']) {
                                    echo 'is-invalid';
                                }
                            }
                            ?>
                        " placeholder="Last Name*" value="<?php echo $lastname ?>">
                        <div class="text-danger">
                            <small><?php echo $errors['lastname'] ?? '' ?></small>
                        </div>
                    </div>
                </div>
                <!--email-->
                <div class="form-group mt-2">
                    <input type="text" name="email" id="email" class="form-control
                        <?php
                        if (!empty(($email))) {
                            echo $errors['email'] ? 'is-invalid' : 'is-valid';
                        } else {
                            if ($errors['email']) {
                                echo 'is-invalid';
                            }
                        }
                        ?>
                    " placeholder="Enter email*" value="<?php echo $email ?>">
                    <div class="text-danger">
                        <small><?php echo $errors['email'] ?? '' ?></small>
                    </div>
                </div>
                <!--password1-->
                <div class="form-group mt-2">
                    <input type="password" name="password1" id="password1" class="form-control
                        <?php
                        if (!empty(($password1))) {
                            echo $errors['password1'] ? 'is-invalid' : 'is-valid';
                        } else {
                            if ($errors['password1']) {
                                echo 'is-invalid';
                            }
                        }
                        ?>
                    " placeholder="Enter password*" value="<?php echo $password1 ?>">
                    <div class="text-danger">
                        <small><?php echo $errors['password1'] ?? '' ?></small>
                    </div>
                </div>
                <!--password2-->
                <div class="form-group mt-2">
                    <input type="password" name="password2" id="password2" class="form-control
                        <?php
                        if (!empty(($password2))) {
                            echo $errors['password2'] ? 'is-invalid' : 'is-valid';
                        } else {
                            if ($errors['password2']) {
                                echo 'is-invalid';
                            }
                        }
                        ?>
                    " placeholder="Re-enter password*" value="<?php echo $password2 ?>">
                    <div class="text-danger">
                        <small><?php echo $errors['password2'] ?? '' ?></small>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-end align-items-center mt-2">
                    <a href="admin_users.php" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" name="create" class="btn btn-primary">Create</button>
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