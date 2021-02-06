<?php
if ($user->isAdmin() === 0) {
    message('danger', 'You have to be an admin to access this page');
    redirect(BASE_URL . '/admin/dashboard.php');
}
