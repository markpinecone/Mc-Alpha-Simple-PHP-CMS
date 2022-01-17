<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isAdmin()) {
    header('Location: /index.php?error=forbidden');
    exit();
} else {
	require_once FUNCTIONS_DIR . '/table.func.php';
	require_once INCLUDE_DIR . '/users.inc.php';
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
	echo '<form method="post" action="">';
	showTable($conn, $array, 'Users');
	echo '</form>';
	if(isset($_GET["edit"])) {
		echo '<div class="update-form">';
		require FORMS_DIR . '/signup.form.php';
		echo '</div>';
	}

}
