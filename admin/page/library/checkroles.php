<?php
include("auth.php");

function protectPathAccess() {

    $auth = new Auth();
    
    if ($auth->is_logged_in()) {
        if ($_SESSION['role_id'] != 1) {
            header("Location: /admin/page/include/no_access.php");
            exit;
        }
    } else {
        header("Location: /login.php");
        exit;
    }
}
?>
