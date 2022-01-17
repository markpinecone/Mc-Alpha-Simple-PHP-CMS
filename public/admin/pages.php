<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (isAdmin() !== true) {
    header('Location: /index.php?error=forbidden');
    exit();
} else {
    require_once FUNCTIONS_DIR . '/table.func.php';
    require_once INCLUDE_DIR . '/pages.inc.php';
    echo '<h2>Pages</h2>';
	$array = array(
		"ID" => "id",
		"Title" => "title",
		"Priority" => "order",
		"Last Update" => "edited",
	);
	echo '<form method="post" action="">';
	showTable($conn, $array, 'Pages');
	echo '</form>';
	require_once FORMS_DIR . '/pages.form.php';
}
