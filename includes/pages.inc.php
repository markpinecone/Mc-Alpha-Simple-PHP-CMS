<?php
require_once INCLUDE_DIR . '/dbh.inc.php';

if (isset($_POST["add"])) {
    $title = test_input($_POST["title"]);
    $content = test_input($_POST["content"]);
	$order = (int) $_POST["order"];	
    createPage($conn, $title, $content, $order);
}

if (isset($_POST["delete"])) {
	if(!empty($_POST["selected"])) {
		foreach($_POST["selected"] as $selected) {
			try {
				$selected = (int) $selected;
				deleteRow($conn, 'pages', $selected, 'Pages');
			} catch (Exception $e) {
				echo 'Caught exception: ' . $e->getMessage() . '<br>'; 
			}
		}
	}
}	
