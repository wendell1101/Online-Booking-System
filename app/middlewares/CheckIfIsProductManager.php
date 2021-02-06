<?php
if ($user->is_product_manager === 0) {
    message('danger', 'You have to be an admin or product manager to access this page');
    redirect(BASE_URL . 'index.php');
}
