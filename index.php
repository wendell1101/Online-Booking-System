<?php
include "path.php";
require_once BASE . '/app/core.php';
require_once BASE . '/app/middlewares/Auth.php';
$auth = new Auth();

$auth->restrict();


?>
<?php include 'app/includes/header.php' ?>

<?php include 'app/includes/message.php' ?>
<div class="container">

</div>

<?php include 'app/includes/footer.php' ?>