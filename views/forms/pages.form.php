<?php
if (!isset($_GET["edit"])) {
	echo '<h3>Add new page</h3>';
	$pageID = NULL;
} else { 
	echo '<h3>Edit page</h3>';
	if (!empty($_GET["edit"])) {
		$pageID = (int) $_GET["edit"];
	}
}
function fetchInputData($field, $id, $table) {
	if (isAdmin() && isset($_GET["edit"])) {
		if ($id) {
			require INCLUDE_DIR . '/dbh.inc.php';
			$data = getDataRows($conn, $id, $table);
			return $data[$field];
		} else {
			header("location: /admin/index.php?action=pages&error=fetchfailure");
			exit();
		}
	} else {
		return (isset($_POST['$field']) ? $_POST['$field'] : ''); 	
	}
} 
?>
<form action="" method="post">
	<input class="inputfield" type="text" id="Title" name="title" value="<?php 
			echo fetchInputData('title', $pageID, 'pages'); 
		?>" placeholder="Title required" required><br><br>
	<label for="order">Priority: </label>	
	<input class="inputfield" style="max-width: 25px;" type="number" name="order" value="<?php 
			if (!isset($_GET["edit"])) { 
				echo (countTableRows($conn, 'Pages') + 1); 
			} else { 
				echo (fetchInputData('order', $pageID, 'Pages')); 
			}
		?>" required><br><br>
	<textarea id="content" name="content" placeholder="Add content here.."><?php 
			echo fetchInputData('content', $pageID, 'Pages'); 
		?></textarea><br><br>
	<input type="submit" 
		<?php echo (!isset($_GET["edit"]) ? 
		'name="add" value="Add page">' : 
		'name="updatepage" value="Update page">');
		?> 
</form>
