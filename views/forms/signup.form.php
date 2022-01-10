<?php 
echo ($_GET["action"] !== "users" ? '<h3>User Sign Up</h3>' : '<h3>Change user details</h3>');
if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
	$userid = (int) $_GET["edit"];
} else {
	$userid = NULL;
}	
function fetchInputData($field, $id, $table) {
	if (isAdmin() && isset($_GET["edit"])) {
		if ($id) {
			require INCLUDE_DIR . '/dbh.inc.php';
			$data = getDataRows($conn, $id, $table);
			return $data[$field];
		} else {
			header("location: /admin/index.php?action=users&error=fetchfailure");
			exit();
		}
	} else {
		return (isset($_POST['$field']) ? $_POST['$field'] : ''); 	
	}
} 

?>
    <div id="form">
        <form method="post" action="">

            <!-- Email input -->
            <div class="">
				<input type="email" name='email' value="<?php echo fetchInputData('email', $userid, 'users') ?>"
                       id="" class="" placeholder="E-mail">
            </div>
            <br>
            <div class="">
                <input type="name" name='name' value="<?php echo fetchInputData('name', $userid, 'users') ?>""
                       placeholder="First Name">
            </div>
            <br>
            <div class="">
                <input type="lastname" name='lastname'
                       value="<?php echo fetchInputData('lastname', $userid, 'users') ?>"
                       placeholder="Last Name">
            </div>
            <br>

            <!-- Password input -->
            <div class="">
                <input type="password" name='pass' placeholder="Enter password">
            </div>
            <br>
            <div class="">
                <input type="password" name='repeat-pass' placeholder="Repeat password" >
            </div>
            <br>
            <button type="submit" value="submit" name="submit" class="">Sign Up</button>
        </form>
    </div>
