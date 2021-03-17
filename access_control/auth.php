<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['usr_id']) && !empty($_SESSION['usr_id'])) {
    if ($_SESSION['usr_is_superadmin'] == 1) {
        //super admin
        header('Location: dashboard_superadmin.php');
    } else if ($_SESSION['usr_is_superadmin'] == 0) {
        //system users
        header('Location: dashboard.php');
    }
} 
?>



