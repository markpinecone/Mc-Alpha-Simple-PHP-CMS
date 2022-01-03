<?php
if (isAdmin() !== true) {
    header('Location: /index.php?error=bla');
    exit();
} else {
    require_once '../../config/config.php';
    require_once FUNCTIONS_DIR . '/functions.func.php';
    require_once FUNCTIONS_DIR . '/table.func.php';
    require_once INCLUDE_DIR . '/pages.inc.php';
    echo '<h2>Pages</h2>';
	$array = array(
		"ID" => "id",
		"Title" => "title",
		"Priority" => "orderby",
		"Last Update" => "edited",
	);
	showTable($conn, $array, 'Pages');
	require_once FORMS_DIR . '/pages.form.php';
}
