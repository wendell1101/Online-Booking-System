<?php
include 'path.php';
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Guess.php';

$firstname = $lastname = $email = $password1 = $password2 = $agree = '';
if (isset($_POST['register'])) {
    // instantiate user validator
    $user = new UserController($_POST);
    $errors = $user->validate();

    //get the data
    $data = $user->getData();
    $firstname = sanitize($data['firstname']);
    $lastname = sanitize($data['lastname']);
    $email = sanitize($data['email']);
    $password1 = sanitize($data['password1']);
    $password2 = sanitize($data['password2']);
    $agree = sanitize($data['agree']);
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

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-5 mx-auto shadow p-3 bg-white register">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h4 class="text-center pb-3 border-bottom mb-3">Register Now! <a href="index.php" class="text-primary">Coffee Royale</a></h4>

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

                    <div class="form-group mt-2">
                        <input type="checkbox" checked name="agree" id="agree" value="<?php echo $agree ?>" required>
                        <a>I agree to the Terms and Conditions</a>
                        <div class="terms text-secondary">
                            <span class="terms-title">Terms and Condition</span><br>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla eum provident dolor neque. Error atque, sint accusantium nihil dignissimos rem ex dolorum repellendus culpa consequatur ipsam, id omnis eos magnam?
                        </div>
                    </div>
                    <div class="form-group">
                        <span>Already a user ? <a href="login.php">Login here</a></span>
                    </div>
                    <div class="d-grid mt-2">
                        <button type="submit" name="register" class="btn btn-primary btn-block">Create Account</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>