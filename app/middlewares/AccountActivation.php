<?php
// if not set redirect back
if (!isset($_SESSION['activate'])) {
    header("location:javascript://history.go(-1)");
    if (!isset($_SESSION['activate'])) {
        header("location:javascript://history.go(-1)");
    }
}

?>

<?php
if (!isset($_SESSION['activate'])) {
    header("location:javascript://history.go(-1)");
}
