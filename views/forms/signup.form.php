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
				<input type="email" name='email' value="<?php 
						echo fetchInputData('email', $userid, 'users'); 
					?>" id="" class="" placeholder="E-mail">
            </div>
            <br>
            <div class="">
				<input type="name" name='name' value="<?php 
						echo fetchInputData('name', $userid, 'users'); 
					?>" placeholder="First Name">
            </div>
            <br>
            <div class="">
                <input type="lastname" name='lastname' value="<?php 
						echo fetchInputData('lastname', $userid, 'users');
					?>" placeholder="Last Name">
            </div>
			<br>
			<?php 
				if(isset($_GET["edit"])) {
					echo '<div style="float: left;">
						<label for="role">Role:</label>	
						<select name="role">
							<option value="user">User</option>
							<option value="admin">Admin</option>
						</select></div><br><br>';
					echo '<button type="update" value="update" name="update" class="">Update User</button><br><br>';
			
				}
			?>
            <!-- Password input -->
            <div class="">
                <input type="password" name='pass' placeholder="Enter password">
            </div>
            <br>
            <div class="">
                <input type="password" name='repeat-pass' placeholder="Repeat password" >
            </div>
			<br>
			<?php 
				if ($_GET["action"] != 'users') {
				echo '<button type="submit" value="submit" name="submit" class="">Sign Up</button>';
				} else {
				echo '<button type="submit" value="updatepass" name="updatepass" class="">Change Password</button>';
				}
			?>
        </form>
    </div>
