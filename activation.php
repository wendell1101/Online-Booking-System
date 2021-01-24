<?php
require_once 'app/core.php';
require_once 'app/middlewares/AccountActivation.php';


$errors = ['active' => ''];
$active = '';
if(isset($_POST['active'])){
    if (empty($_POST['active'] )) {
        $errors['active'] = 'Activation code must not be empty';
    }else{
        $active = htmlspecialchars($_POST['active']);
        if(isset($_SESSION['token'])){
            if($active !== $_SESSION['token']){
                $errors['active'] = 'Activation code is incorrect. Please try again';
            }
        }

    }
}
if (isset($_GET['active']) || isset($_POST['submit'])) {
    // check if active is empty

    if (!array_filter($errors)) {
        $tk = isset($_POST['submit']) ? $_POST['active'] : $_GET['active'];
        $id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
        $user = new UserController($_POST || $_GET);
        $request = $user->activate($id, $tk);
        if($request){
            unset($_SESSION['active']);
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Account</title>
    <!--fontawesome5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--custom css -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <?php include 'app/includes/message.php' ?>
                    <div class="card-header">
                        Activate your account
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <label for="acive">Activate</label>
                                <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                                <input type="active" name="active" id="active" class="form-control
                                    <?php
                                    if (!empty($active)) {
                                        echo $errors['active'] ? 'is-invalid' : 'is-valid';
                                    } else {
                                        if ($errors['active']) {
                                            echo 'is-invalid';
                                        }
                                    }
                                    ?>
                                ">
                                <div class="text-danger">
                                    <?php echo $errors['active'] ?>
                                </div>
                            </div>

                            <div class="d-grid mt-2">
                                <button type="submit" name="submit" class="btn btn-danger btn-block">Activate</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        We have sent you an email kindy activate your account.
                        You can paste the code above or just use the link that has been sent to your email.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>