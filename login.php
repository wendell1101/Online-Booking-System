<?php
require_once('app/core.php');
require_once('app/middlewares/Guess.php');
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
<?php include 'app/includes/header.php' ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                <h5 class="text-center text-secondary">Login with</h5>

                <a href="#" class="form-group form-control border p-2 text-center google">
                    <i class="authentication-icon google-icon fab fa-google-plus-g mr-2"></i>
                    <span>Continue with Google</span>
                </a>
                <a href="#" class="form-group form-control border p-2 text-center facebook">
                    <i class="authentication-icon facebook-icon fab fa-facebook-square mr-2"></i>
                    <span>Continue with Facebook</span>
                </a>
                <h5 class="text-center text-secondary">Or</h5>

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

                <div class="d-grid mt-2">
                    <button class="btn btn-danger btn-block" name="login">Login</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php include 'app/includes/footer.php' ?>