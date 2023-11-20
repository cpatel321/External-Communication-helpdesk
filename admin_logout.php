<?php
session_start(); // Start the session.

// If the logout button is clicked.
if (isset($_POST['logout'])) {
    // Unset all of the session variables.
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page.
    header("Location: admin_login.html");
    exit;
}
?>
