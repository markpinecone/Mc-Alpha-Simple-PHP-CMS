<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isAdmin()) {
    header('Location: /index.php?error=forbidden');
    exit();
} else {
	require_once FUNCTIONS_DIR . '/table.func.php';
	require_once INCLUDE_DIR . '/users.inc.php';
    echo '<h2 class="mt-3 mb-3">Users</h2>';
	// displayUsersTable($conn);
	$array = array(
		'#' => 'id',
		'E-Mail' => 'email',
		'Name' => 'name',
    'Last name' => 'lastname',
    'Display name' => 'display_name',
		'Role' => 'role',
		'Registration Date' => 'registered',
	);
	echo '<form method="post" action="">';
	showTable($conn, $array, 'Users');
  echo '</form>';
  if(isset($_POST['delete'])){
      if(!empty($_POST['row'])){
      foreach($_POST['row'] as $checked){
      try {
        deleteRow($conn, $_GET["action"], $checked, 'users');
      }
      catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      } 
    }
    header("location: /admin/index.php?action=users&notify=deletesuccess");
    }
  }  

	if(isset($_GET["edit"])) {
		echo '<div class="update-form">';
		require FORMS_DIR . '/signup.form.php';
		echo '</div>';
	}

}
