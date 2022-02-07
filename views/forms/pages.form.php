<?php
if (!isset($_GET["edit"])) {
    echo '<h3>Add new page</h3>';
    $pageID = null;
} else {
    echo '<h3>Edit page</h3>';
    if (!empty($_GET["edit"])) {
        $pageID = (int) $_GET["edit"];
    }
}
?>
<form action="" method="post">
  <div class="form-group col-md-4 mb-3">
    <label for="Title" class="form-label">Title</label> 
	  <input class="form-control" type="text" id="Title" name="title" value="<?php
            echo fetchInputData('title', $pageID, 'pages');
        ?>" required>
  </div>
  <div class="form-group col-md-4 mb-3">  
    <label class="form-label" for="order">Priority</label>	
	  <input class="form-control" type="number" name="order" value="<?php
            if (!isset($_GET["edit"])) {
                echo(countTableRows($conn, 'Pages') + 1);
            } else {
                echo(fetchInputData('order', $pageID, 'Pages'));
            }
      ?>" required>
  </div>
  <div class="form-group col-md-4 mb-3">
  <label class="form-label" for="content">Content</label>
	<textarea class="form-control h-75 d-inline-block" id="content" name="content" placeholder="Add content here.."><?php
            echo fetchInputData('content', $pageID, 'Pages');
        ?></textarea><br><br>
	<input type="submit" class="btn btn-secondary" 
		<?php echo(!isset($_GET["edit"]) ?
        'name="add" value="Add page">' :
        'name="updatepage" value="Update page">');
        ?> 
</form>
