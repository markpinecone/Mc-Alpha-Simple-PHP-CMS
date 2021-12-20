<?php
session_start();
require_once '../config/config.php';
require VIEWS_DIR . '/header.view.php';
require VIEWS_DIR . '/navbar.view.php';
if (isLoggedIn()) {
    header('Location: /index.php');
}
require_once FORMS_DIR . '/login.form.php';
require INCLUDE_DIR . '/login.inc.php';
require VIEWS_DIR . '/footer.view.php';
