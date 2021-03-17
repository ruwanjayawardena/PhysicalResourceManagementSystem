<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['usr_id']) && !empty($_SESSION['usr_id'])) {
    if ($_SESSION['usr_is_superadmin'] == 0) {
        //system users
        header('Location: dashboard.php');
    }
} else {
    header('Location: index.php');
}
?>