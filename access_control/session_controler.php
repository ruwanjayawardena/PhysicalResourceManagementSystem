<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['usr_id']) && empty($_SESSION['usr_id'])) {
    header('Location: index.php');
}
?>
