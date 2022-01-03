<?php
if (!isAdmin()) {
    header('Location: /index.php');
    exit();
} else {
    echo '<h2>Users</h2>';
    include_once FUNCTIONS_DIR . '/table.func.php';
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
