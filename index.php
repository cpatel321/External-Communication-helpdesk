<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    // If logged in, redirect to admin_panel.php
    header("Location: admin_panel.html");
    exit();
} else {
    // If not logged in, redirect to admin_login.php
    header("Location: admin_login.html");
    exit();
}
?>
