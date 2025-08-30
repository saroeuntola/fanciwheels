<?php
include("auth.php");

function protectRouteAccess() {
    $auth = new Auth();
   if ($auth->is_logged_in()) {
    if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 3) {
        header("Location: /admin/page/include/no_access");
        exit;
    }
} else {
    header("Location: login");
    exit;
}

}
?>
