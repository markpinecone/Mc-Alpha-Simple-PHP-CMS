<?php
session_start();
require_once '../../config/config.php';
require VIEWS_DIR . '/header.view.php';
echo '<h1>Admin Panel</h1>';
require VIEWS_DIR . '/navbar.view.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isLoggedIn()) {
    header('Location: /login.php');
    exit();
}
if ($_SESSION['role'] != 'admin') {
    header('Location: /index.php');
    exit();
}

if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
    exit();
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "pages") {
        include 'pages.php';
    }
    if ($_GET["action"] == "users") {
        include 'users.php';
    }

} else {
	echo '<h2>Admin Dashboard<h2>';    
}

require VIEWS_DIR . '/footer.view.php';
