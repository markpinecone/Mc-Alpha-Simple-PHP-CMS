<?php
session_start();
require_once '../config/config.php';
require_once VIEWS_DIR . '/header.view.php';
require_once VIEWS_DIR . '/navbar.view.php';

if (isLoggedIn()) {
    header('Location: /index.php');
    exit();
}
require_once FORMS_DIR . '/signup.form.php';
require_once INCLUDE_DIR . '/signup.inc.php';
require VIEWS_DIR . '/footer.view.php';
