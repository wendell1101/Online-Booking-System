<?php
    require_once('app/core.php');
    if(User::Auth()){
        $user = $_SESSION['user'];
    }


?>
<?php include 'app/includes/header.php'?>

<?php include 'app/includes/footer.php'?>