<?php 
if (isset($_POST["delete"])) {
	if(!empty($_POST["selected"])) {
		foreach($_POST["selected"] as $selected) {
			try {
				$selected = (int) $selected;
				deleteRow($conn, 'users', $selected, 'Users');
			} catch (Exception $e) {
				echo 'Caught exception: ' . $e->getMessage() . '<br>'; 
			}
		}
	}
}
