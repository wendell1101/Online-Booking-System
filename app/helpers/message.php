<?php
function message($type, $message)
{
    $alert = "<div class='alert alert-$type p-2'>$message</div>";
    $_SESSION['message'] = $alert;
}
