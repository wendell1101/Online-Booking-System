<?php require_once 'app/core.php';?>

<?php if(isset($_SESSION['message'])):?>
    <div class='alert alert-success'>
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
    </div>
<?php endif;?>
