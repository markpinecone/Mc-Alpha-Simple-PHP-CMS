<?php
session_start();
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isLoggedIn()) {
    header('Location: /login.php');
    exit();
} elseif ($_SESSION['role'] != 'admin') {
    header('Location: /index.php');
    exit();
} else {
	require VIEWS_DIR . '/header.view.php';
	require VIEWS_DIR . '/navbar_adm.view.php';
	if (isset($_GET["action"])) {
		$action = filter_var($_GET["action"], FILTER_UNSAFE_RAW);
		switch($action) {
			case("pages"):
				require 'pages.php';
				break;
			case("users"):
				require 'users.php';
				break;
			case("logout"):
				require INCLUDE_DIR . '/logout.inc.php';
				break;
			default:
				break;
		}
	} else {
		echo '<h2>Admin Dashboard<h2>';    
	}

	require VIEWS_DIR . '/footer.view.php';
}
