<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isLoggedIn()) {
    header('Location: /login.php');
    die();
} else {
    echo '<h2>Users</h2>';
    include FUNCTIONS_DIR . '/test.func.php';
}