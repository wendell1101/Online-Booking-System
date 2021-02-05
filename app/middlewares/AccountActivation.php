<?php
// if not set redirect back
if (!isset($_SESSION['activate'])) {
    header("location: login.php");
}

?>

<?php
