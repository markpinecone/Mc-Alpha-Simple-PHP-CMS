<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isAdmin()) {
    header('Location: /index.php?error=forbidden');
    exit();
} else {
	include_once FUNCTIONS_DIR . '/table.func.php';
    echo '<h2>Users</h2>';
	// displayUsersTable($conn);
	$array = array(
		'ID' => 'id',
		'E-Mail' => 'email',
		'Name' => 'name',
		'Last name' => 'lastname',
		'Role' => 'role',
		'Registration Date' => 'registered',
	);
	showTable($conn, $array, 'Users');

}
