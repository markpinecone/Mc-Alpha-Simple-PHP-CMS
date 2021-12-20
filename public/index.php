<?php
session_start();
require_once '../config/config.php';
require VIEWS_DIR . '/header.view.php';
require VIEWS_DIR . '/navbar.view.php';
if (isset($_GET['id'])) {
    getContent($conn, $_GET['id']);
}
require VIEWS_DIR . '/footer.view.php';