<?php
    require_once('app/core.php');
    require_once('app/middlewares/Auth.php');
    if(User::Auth()){
        // print_r($user->getUser());
    }


?>
<?php include 'app/includes/header.php'?>

<?php include 'app/includes/footer.php'?>