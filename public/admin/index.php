<?php
session_start();
if (!$_SESSION["LoggedIn"]) {
    header("Location: /admin/login.php");
} else {
    include '../header.php';
    include 'navbar.php';
    echo '<h1>Admin</h1>';
    include '../footer.php';
}