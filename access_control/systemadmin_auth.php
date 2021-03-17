<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['usr_id']) && !empty($_SESSION['usr_id'])) {
    if ($_SESSION['usr_is_superadmin'] == 1) {
        //system users
        header('Location: dashboard_superadmin.php');
    }
} else {
    header('Location: index.php');
}
?>