<?php
    require_once('app/core.php');
    require_once('app/middlewares/Auth.php');
    $auth = new Auth();

    $auth->restrict();


?>
<?php include 'app/includes/header.php'?>

<?php include 'app/includes/message.php'?>

<?php include 'app/includes/footer.php'?>