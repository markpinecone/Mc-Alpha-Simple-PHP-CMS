<?php
if (!isAdmin()) {
    header('Location: /index.php');
    exit();
} else {
    echo '<h2>Users</h2>';
    include FUNCTIONS_DIR . '/test.func.php';
}