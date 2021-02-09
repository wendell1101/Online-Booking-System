<?php
include 'path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Guess.php';

$email = $password1 = '';
if (isset($_POST['login'])) {
    // instantiate user validator
    $user = new UserController($_POST);
    $errors = $user->validateLogin();
    //get the data
    $data = $user->getData();

    $email = sanitize($data['email']);
    $password1 = sanitize($data['password1']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE ?></title>
    <!--fontawesome5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--custom css -->
    <!--flatpckr -->
    <link rel="stylesheet" href="node_modules/flatpickr/dist/flatpickr.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
    <!--custom css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/sub-main.css">
</head>

<body style="background: #3f240d">


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 m-auto border p-3 pt-5 pb-5 login">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                    <h5 class="text-center text-secondary mb-3">Login Now</h5>
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
                    if (!empty($password1)) {
                        echo $errors['password1'] ? 'is-invalid' : '';
                    } else {
                        if ($errors['password1']) {
                            echo 'is-invalid';
                        }
                    }
                    ?>
                    " placeholder="Enter password*">
                        <div class="text-danger">
                            <small><?php echo $errors['password1'] ?? '' ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <span>Not yet a user? <a href="register.php">Register here</a></span>
                    </div>
                    <div class="d-grid mt-2">
                        <button class="btn btn-primary btn-block" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>