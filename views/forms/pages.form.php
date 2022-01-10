<?php
if (!isset($_GET["edit"])) {
	echo '<h3>Add new page</h3>';
} else { echo '<h3>Edit page</h3>'; }

?>
<form action="index.php?action=pages" method="POST">
    <input id="title" type="text" id="Title" name="title" placeholder="Title required" required><br><br>
    <input id="title" type="number" name="order" value="<?php echo (countTableRows($conn, 'Pages') + 1) ?>" placeholder="Order required" required><br><br>
    <textarea id="content" name="content" placeholder="Add content here.."></textarea><br><br>
	<input type="submit" 
		<?php echo (!isset($_GET["edit"]) ? 
		'name="add" value="Add page"' : 
		'name="update" value="Update page">'); 
		?> 
</form>
